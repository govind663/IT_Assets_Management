<?php

namespace App\Http\Livewire;

use App\Models\Catagories;
use App\Models\Department;
use App\Models\NewMaterial;
use App\Models\Product;
use App\Models\RequestMaterialProduct;
use App\Models\StockDetail;
use App\Models\Unit;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class EditNewMaterial extends Component
{
    use WithFileUploads;

    // COPONENT VARIABLES
    public $updatenewMaterialstatus;
    public $loop_products;
    public $loop_units;
    public $formCounts = 1;

    // FORM MODELS
    public $data;
    public $materialDoc;
    public $materialID;
    public $name;
    public $department_id;
    public $mobile_no;
    public $email;
    public $requested_at;
    public $material_doc;


    // PRODUCT FORMS
    public $requestMaterialProductID;
    public $product_code;
    public $categories_id;
    public $product_id;
    public $brand;
    public $model;
    public $unit_id;
    public $quantity;
    public $currentquantity;

    // Show  or Hide forms
    public $fileUploaded = false;

    public function render()
    {
        $departments = Department::select('dept_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        // get all StockDetail  and Category for select option in form
        $currentstock =  StockDetail::pluck('catagories_id');
        // dd($currentstock);

        // ==== Catagories check in StockDetail table  and return the result to view page.
        $categories = Catagories::select('catagories_name', 'id')
                                    ->whereIn('id',  $currentstock)
                                    ->whereNull('deleted_at')
                                    ->orderByDesc('id')
                                    ->get();

        return view('livewire.edit-new-material', ['departments' => $departments, 'categories'=> $categories]);
    }

    //  Update form fields to the loop
    public function submitApplication(Request $request)
    {
        $this->addValidate();

        $newMaterial = NewMaterial::findOrFail($this->materialID['id']);

        // update document  if file is uploaded or not
        if ($request->hasFile('material_docs')){
            //  store new image and delete old one in storage  folder
            Storage::delete('public/uploads/material_docs' .$newMaterial->material_doc);
            $imageName = time().'.'.$request->material_docs->extension();
            $request->material_docs->store('uploads/material_doc', $imageName,  'public');
            $this->material_doc = '/storage/uploads/material_docs/' . $imageName ;
            $this->fileUploaded=true;
            $newMaterial->update(['material_doc'=> $imageName]);
        } elseif (!$this->fileUploaded){
                unset($newMaterial->material_doc );
        }


        // Save data in database
        $newMaterial->update([
            'name' => $this->name ?: null,
            'department_id' => $this->department_id ?: null,
            'mobile_no' =>  $this->mobile_no,
            'email' => $this->email,
            'requested_at' => date("Y-m-d", strtotime($this->requested_at)),
            'modified_by'  => Auth::user()->id,
            'modified_at' => Carbon::now()
        ]);

        // === store all stock details  in a variable and then clear it. ===
        RequestMaterialProduct::where('new_material_id', $this->materialID)->delete();

        //  === save product details into RequestMaterialProduct table.
        foreach ($this->categories_id as $key=>$value) :
            $arr = implode(',', $value);
            if (!empty($value)) :
                RequestMaterialProduct::create([
                    'new_material_id' => $newMaterial->id ,
                    'catagories_id' =>  $arr,
                    'product_id' => $this->product_id[$key],
                    'product_code' => $this->product_code[$key],
                    'brand' =>  $this->brand[$key],
                    'model' =>  $this->model[$key],
                    'unit_id' => $this->unit_id[$key],
                    'quantity' => $this->quantity[$key],
                    'inserted_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            endif;
        endforeach;

        // === update status when other department clerk is  logged in===//
        if (Auth::User()->role_id == 2 || Auth::User()->role_id == 3  && Auth::User()->department_id != 1) {
            $status = ['status'=>0];
            NewMaterial::whereId($newMaterial->id)->update($status);
        }
        return redirect()->route('request-new-material.index')->with('message','Your request for new material has been updated successfully.');;
    }

    //  INITIALIZE COMPONENT
    public function mount()
    {
        $this->data = NewMaterial::find(request()->request_new_material) ?? NewMaterial::first();
        $this->materialDoc = NewMaterial::find(request()->request_new_material) ?? NewMaterial::first()->pluck('material_doc');
        // dd($this->materialDoc);
        $this->materialID = NewMaterial::find(request()->request_new_material)->toArray();
        $this->product_code = RequestMaterialProduct::where('new_material_id', request()->request_new_material)
                                ->value('product_code');

        // ===== get the quantity in stock Details
        $totalcurrentquantity = StockDetail::where("product_code", "=", $this->product_code)->first();


        $request_material_products = RequestMaterialProduct::with('catagory', 'product', 'unit')
                                    ->where('new_material_id', $this->materialID['id'])
                                    ->orderByDesc('id')
                                    ->get();

        foreach ($request_material_products as $key => $request_material_product)
        {
            $this->requestMaterialProductID[$key+1] = $request_material_product['id'];
            $this->categories_id[$key+1] = $request_material_product['catagories_id'];
            $this->product_id[$key+1] = $request_material_product['product_id'];
            $this->brand[$key+1] = $request_material_product['brand'];
            $this->model[$key+1] = $request_material_product['model'];
            $this->currentquantity[$key+1] = $totalcurrentquantity['quantity'];
            $this->quantity[$key+1] = $request_material_product['quantity'];
            $this->unit_id[$key+1] = $request_material_product['unit_id'];

            $products = Product::where("catagories_id", $this->categories_id[$key+1])
                                ->whereNull('deleted_at')
                                ->orderByDesc('id')
                                ->select("id", "name")->get();

            if($products)
                $this->loop_products[$key+1] = $products;

            $units = Unit::whereNull('deleted_at')->get();
            if($units)
                $this->loop_units[$key+1] = $units;
        }

        $this->name = $this->materialID['name'];
        $this->department_id = $this->materialID['department_id'];
        $this->mobile_no = $this->materialID['mobile_no'];
        $this->email = $this->materialID['email'];
        $this->requested_at = $this->materialID['requested_at'];

        // === check file is present or not

        $this->material_doc = $this->materialID['material_doc'];

        $this->formCounts = $request_material_products->count();
    }

    // ======= GET PRODUCT CATRGORYWISE
    public function updatedCategoriesId($val, $key)
    {
        // get all StockDetail and Product for select option in form
        $this->categories_id[$key] =  StockDetail::pluck('catagories_id');

        $products = Product::where("catagories_id", $this->categories_id[$key])
                        ->whereNull('deleted_at')
                        ->orderByDesc('id')
                        ->select("id", "name")->get();

        if($products)
        {
            $this->loop_products[$key] = $products;
        }
    }

    // ======= GET PRODUCT DETAILS PRODUCTIDWISE
    public function updatedProductId($val, $key)
    {
        $stockDetails = StockDetail::where("product_id", $this->product_id[$key])->first();
        // dd($stockDetails);

        // === null value check then set default
        $this->product_id[$key]       =  isset($stockDetails->product->name) ? $stockDetails->product->name : '';
        $this->unit_id[$key]          =  isset($stockDetails->product->unit_id) ? $stockDetails->product->unit_id : '';
        $this->brand[$key]            =  isset($stockDetails->brand) ? $stockDetails->brand : '';
        $this->model[$key]            =  isset($stockDetails->model_no) ? $stockDetails->model_no : '';
        $this->currentquantity[$key]  =  isset($stockDetails->quantity) ? $stockDetails->quantity : '';
        $this->product_code[$key]     =  isset($stockDetails->product_code) ? $stockDetails->product_code : "";

        $this->product_id[$key] =  StockDetail::pluck('product_id')
                                                ->whereNull('deleted_at')
                                                ->contains($val)?$val:null;

        $prod = Product::where("id", $this->product_id[$key])
                        ->whereNull('deleted_at')
                        ->orderByDesc('id')
                        ->select("id", "name", 'unit_id', 'brand', 'model_no')
                        ->first();

        if($prod)
        {
            $this->brand[$key] = $prod->brand;
            $this->model[$key] = $prod->model_no;
            $this->unit_id[$key] = $prod->unit_id;

            $units = Unit::whereNull('deleted_at')->get();
            if($units)
            {
                $this->loop_units[$key] = $units;
            }
        }
    }

    // ====== ADD MORE ROW
    public function addMore()
    {
        if($this->formCounts < 10)
        {
            $this->formCounts = ++$this->formCounts;
            $this->categories_id[$this->formCounts] = [];
            $this->product_id[$this->formCounts] = [];
            $this->brand[$this->formCounts] = [];
            $this->model[$this->formCounts] = [];
            $this->unit_id[$this->formCounts] = [];
            $this->currentquantity[$this->formCounts] = [];
            $this->loop_products[$this->formCounts] = $this->loop_products[$this->formCounts-1];
            $this->loop_units[$this->formCounts] = $this->loop_units[$this->formCounts-1];
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'You can not add more than 10 items']);
        }
    }

    // ====== REMOVE ROW
    public function remove()
    {
        //  If the user is trying to remove last row then do not allow
        if($this->formCounts > 1)
        {
            unset($this->categories_id[$this->formCounts]);
            unset($this->product_id[$this->formCounts]);
            unset($this->brand[$this->formCounts]);
            unset($this->model[$this->formCounts]);
            unset($this->unit_id[$this->formCounts]);
            unset($this->currentquantity[$this->formCounts]);
            unset($this->quantity[$this->formCounts]);
            --$this->formCounts;

            //  Reset the last form to have all data filled in again.
            $lastFormKey = $this->formCounts - 1;
            $this->categories_id[$lastFormKey] = $this->categories_id[$this->formCounts];
            $this->product_id[$lastFormKey] = $this->product_id[$this->formCounts];
            $this->brand[$lastFormKey] = $this->brand[$this->formCounts];
            $this->model[$lastFormKey] = $this->model[$this->formCounts];
            $this->unit_id[$lastFormKey] = $this->unit_id[$this->formCounts];
            $this->currentquantity[$lastFormKey] = $this->currentquantity[$this->formCounts];
            $this->quantity[ $lastFormKey ]=  "1";
        }
    }

    // === FORM VALIDATION
    public function addValidate()
    {
        $this->resetErrorBag();

        $fieldArray = [];
        $messageArray = [];

        // Field Required Validation
        for ($i=1; $i<=$this->formCounts; $i++)
        {
            $fieldArray['categories_id.'.$i] = 'required';
            $fieldArray['product_id.'.$i] = 'required';
            $fieldArray['brand.'.$i] = 'required';
            $fieldArray['model.'.$i] = 'required';
            $fieldArray['unit_id.'.$i] = 'required';
            $fieldArray['quantity.'.$i] = 'required';

            $messageArray['categories_id.'.$i . '.required'] = 'Please select any category';
            $messageArray['product_id.' . $i . '.required'] = 'Please select a product';
            $messageArray['brand.' . $i . '.required'] = 'Brand is required';
            $messageArray['model.' . $i . '.required'] = "Model is required";
            $messageArray['unit_id.' . $i . '.required'] = 'Unit is required';
            $messageArray['quantity.' . $i . '.required'] = 'Quantity is required';
        }

        $fieldArray['name'] = 'required';
        $fieldArray['department_id'] = 'required|exists:departments,id';
        $fieldArray['mobile_no'] = 'required|max:10';
        $fieldArray['email'] = 'required|max:255';
        $fieldArray['requested_at'] = 'required|date';
        // $fieldArray['material_doc'] =  'mimes:pdf,jpeg,jpg,png|max:3072';

        $messageArray['name.required'] =  'Name is required';

        $messageArray['department_id.required'] = 'Department name is required';
        $messageArray['department_id.exists'] = 'Department does not exist in the database';

        $messageArray['mobile_no.required'] =  'Mobile number is required.';
        $messageArray['mobile_no.unique'] = 'This mobile number has already been taken';
        $messageArray['mobile_no.max'] = 'The maximum length of   mobile field can be 10 characters';

        $messageArray['email.required'] =  'Email Id is required';
        $messageArray['email.unique']  = 'This email address has already been taken';
        $messageArray['email.max'] = 'The maximum length of email can be 255 characters';

        $messageArray['requested_at.required'] =  'Material Request Date is required';

        // $messageArray['material_doc.required'] =  'Document is required';
        // $messageArray['material_doc.mimes'] = 'Only jpeg, png and pdf are allowed';
        // $messageArray['material_doc.max'] = 'Maximum size for document should be 3MB';


        $validator = Validator::make([
                            'categories_id' => $this->categories_id,
                            'product_id' =>  $this->product_id,
                            'brand' => $this->brand,
                            'model' => $this->model,
                            'unit_id' => $this->unit_id,
                            'quantity' => $this->quantity,
                            'name' => $this->name,
                            'department_id' =>  $this->department_id,
                            'mobile_no' => $this->mobile_no,
                            'email' => $this->email,
                            'requested_at' => $this->requested_at,
                            'material_doc' => $this->material_doc
                        ],$fieldArray,$messageArray );

        $validator->validate();
    }

    // ==== check file uploaded or not then show div  otherwise hide it=====//
    public function updatedMaterialDoc($event)
    {
       if(!empty($event)){
           $this->fileUploaded =  $this->material_doc;
       }
    }
}
