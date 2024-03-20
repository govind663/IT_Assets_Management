<?php

namespace App\Http\Livewire;

use App\Models\Catagories;
use App\Models\Department;
use App\Models\NewMaterial;
use App\Models\Product;
use App\Models\RequestMaterialProduct;
use App\Models\Unit;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class AddNewMaterial extends Component
{
    use WithFileUploads;

    // COPONENT VARIABLES
    public $loop_products;
    public $loop_units;
    public $formCounts = 1;

    // FORM MODELS
    public $name;
    public $department_id;
    public $mobile_no;
    public $email;
    public $requested_at;
    public $material_doc;

    // PRODUCT FORMS
    public $categories_id;
    public $product_id;
    public $brand;
    public $model;
    public $unit_id;
    public $quantity;
    public $product_code;

    // Show or Hide forms
    public $fileUploaded = false;

    public function render()
    {
        $departments = Department::select('dept_name', 'id')
                                  ->whereId(Auth::user()->department_id)
                                  ->whereNull('deleted_at')
                                  ->orderByDesc('id')
                                  ->get();

        // ==== Catagories check in StockDetail table  and return the result to view page.
        $categories = Catagories::select('catagories_name', 'id')
                                    ->whereNull('deleted_at')
                                    ->orderByDesc('id')
                                    ->get();
        return view('livewire.add-new-material', ['departments' => $departments, 'categories'=> $categories]);
    }

    public function boot()
    {
        $this->categories_id[$this->formCounts] = [];
        $this->product_id[$this->formCounts] = [];
        $this->brand[$this->formCounts] = [];
        $this->model[$this->formCounts] = [];
        $this->unit_id[$this->formCounts] = [];
        $this->loop_products[$this->formCounts] = [];
        $this->loop_units[$this->formCounts] = [];
    }

    //  Add new form fields to the loop
    public function submitApplication()
    {
        $this->addValidate();

        // ===== store  in DB =======
        $newMaterial = NewMaterial::create([
                            'user_id' => auth()->user()->id,
                            'name' => $this->name ?: null,
                            'department_id' => $this->department_id ?: null,
                            'mobile_no' =>  $this->mobile_no,
                            'email' => $this->email,
                            'requested_at' => date("Y-m-d", strtotime($this->requested_at)),
                            'material_doc' =>  $this->material_doc->store('uploads/material_docs', 'public'),
                            'inserted_by' => Auth::user()->id,
                            'inserted_at' => Carbon::now()
                        ]);

        // ==== Generate Request number
        $requestID = "PMC". "/" . sprintf("%06d", abs((int)$newMaterial->id + 1))  . "/" . date("Y");
        $update = [
            'request_no' => $requestID,
        ];
        NewMaterial::where('id', $newMaterial->id)->update($update);

        //  === save new material product details   into db ===
        foreach ($this->categories_id  as $key=>$value) :
            if (!empty($value)) :
                RequestMaterialProduct::create([
                    'new_material_id' => $newMaterial->id ,
                    'catagories_id' =>  $value,
                    'product_id' => $this->product_id[$key],
                    'product_code' => "PMC_SKU-" . substr(md5(time()), rand(0, 26), 6) .  sprintf("%06d" , DB::table('request_material_products')->max('id') + 1),
                    'brand' =>  $this->brand[$key],
                    'model' =>  $this->model[$key],
                    'unit_id' => $this->unit_id[$key],
                    'quantity' => $this->quantity[$key],
                    'inserted_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            endif;
        endforeach;

        return redirect()->route('request-new-material.index')->with('message','Your request for new material has been submitted successfully.');
    }

    // ======= GET PRODUCT CATRGORYWISE
    public function updatedCategoriesId($val, $key)
    {
        $products = Product::where("catagories_id", $this->categories_id[$key])
                        // ->where("is_available", 1)
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
        $prod = Product::where("id", $this->product_id[$key])
                        // ->where("is_available", 1)
                        ->whereNull('deleted_at')
                        ->orderByDesc('id')
                        ->select("id", "product_code", "name", 'unit_id', 'brand', 'model_no')
                        ->first();
        if($prod)
        {
            $this->brand[$key] = $prod->brand;
            $this->model[$key] = $prod->model_no;
            $this->unit_id[$key] = $prod->unit_id;
            $this->product_code[$key]  = $prod->product_code;

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
            $this->product_code[$this->formCounts] = [];
            $this->brand[$this->formCounts] = [];
            $this->model[$this->formCounts] = [];
            $this->unit_id[$this->formCounts] = [];
            $this->loop_products[$this->formCounts] = [];
            $this->loop_units[$this->formCounts] = [];
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'You can not add more than 10 items']);
        }
    }

    // ====== REMOVE ROW
    public function remove()
    {
        if($this->formCounts > 1)
            $this->formCounts = --$this->formCounts;
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
            $fieldArray['product_id.'.$i] = 'required|unique:request_material_products,product_id,NULL,id,deleted_at,NULL';
            $fieldArray['brand.'.$i] = 'required|unique:request_material_products,brand'.','.'id,deleted_at';
            $fieldArray['model.'.$i] = 'required|unique:request_material_products,model'.','.'id,deleted_at';
            $fieldArray['unit_id.'.$i] = 'required|unique:request_material_products,unit_id,NULL,id,deleted_at,NULL';
            $fieldArray['quantity.'.$i] = 'required';


            $messageArray['categories_id.'.$i . '.required'] = 'Please select any category';
            $messageArray['product_id.' . $i . '.required'] = 'Please select a product';
            $messageArray['brand.' . $i . '.required'] = 'Brand is required';
            $messageArray['model.' . $i . '.required'] = "Model is required";
            $messageArray['unit_id.' . $i . '.required'] = 'Unit is required';
            $messageArray['quantity.' . $i . '.required'] = 'Quantity in Stock is required';
        }

        $fieldArray['name'] = 'required';
        $fieldArray['department_id'] = 'required|exists:departments,id';
        $fieldArray['mobile_no'] = 'required|max:10|unique:new_materials,mobile_no,NULL,id';
        $fieldArray['email'] = 'required|max:255|unique:new_materials,email,NULL,id';
        $fieldArray['requested_at'] = 'required|date';
        $fieldArray['material_doc'] =  'required|mimes:pdf,jpeg,jpg,png|max:3072';

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

        $messageArray['material_doc.required'] =  'Document is required';
        $messageArray['material_doc.mimes'] = 'Only jpeg, png and pdf are allowed';
        $messageArray['material_doc.max'] = 'Maximum size for document should be 3MB';


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
            $this->fileUploaded = true;
           }else{
            $this->fileUploaded = false;
        }
     }

}
