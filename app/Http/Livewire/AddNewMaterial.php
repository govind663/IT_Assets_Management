<?php

namespace App\Http\Livewire;

use App\Models\Catagories;
use App\Models\Department;
use App\Models\NewMaterial;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddNewMaterial extends Component
{
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

    public function render()
    {
        $departments = Department::select('dept_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $categories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

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
        // $vendors = NewMaterial::create([
        //     'vendor_id' => $this->vendor_id ?: null,
        //     'inward_dt' => date("Y-m-d", strtotime($this->inward_dt)),
        //     'voucher_no' =>  $this->voucher_no ?: null,
        //     'material_doc' =>  $this->material_doc ?: null,
        //     'inserted_by' => Auth::user()->id,
        //     'inserted_at' => Carbon::now()
        // ]);

        // ==== Generate Request number
        // $unique_id = "PMC-INV" . sprintf("%06d", abs((int)$vendors->id + 1))  . "/" . date("Y");
        // $update = [
        //     'invoice_no' => $unique_id,
        // ];
        // NewMaterial::where('id', $vendors->id)->update($update);

        //  === save new product details into
        // foreach ($this->categories_id as $key=>$value) :
        //     if (!empty($value)) :
        //         StockDetail::create([
        //             "stock_id" => $vendors->id,
        //             "catagories_id" =>  $value,
        //             "product_id" => $this->product_id[$key],
        //             "brand" => $this->brand[$key],
        //             "model" => $this->model[$key],
        //             "unit_id" => $this->unit_id[$key],
        //             "warranty_dt" =>  isset($this->warranty_dt[$key])?date("Y-m-d",strtotime($this->warranty_dt[$key])):"",
        //             "quantity" =>  $this->quantity[$key],
        //             "inserted_by" => Auth::user()->id,
        //             "inserted_at" => Carbon::now(),
        //         ]);
        //     endif;
        //     //  Reset all field after add one time
        //     // $this->reset(['categories_id', 'product_id','brand','model','unit_id', 'warranty_dt','quantity']);

        //     // ==== Generate  unique SKU for each Product
        //     $sku_id = "PMC_SKU-" . substr(md5(time()), rand(0, 26), 6) .  sprintf("%06d", $this->product_id[$key]);
        //     $skuUpdate = [
        //         "product_code" => $sku_id,
        //     ];
        //     StockDetail::where('product_id', $this->product_id[$key])->update($skuUpdate);
        // endforeach;

        return redirect()->route('request-new-material.index')->with('message','Stock created successfully');;
    }

    // ======= GET PRODUCT CATRGORYWISE
    public function updatedCategoriesId($val, $key)
    {
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
        $prod = Product::where("id", $this->product_id[$key])
                        ->whereNull('deleted_at')
                        ->orderByDesc('id')
                        ->select("id", "name", 'unit_id', 'brand', 'model_no')->first();

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
            $this->loop_products[$this->formCounts] = [];
            $this->loop_units[$this->formCounts] = [];
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
            $fieldArray['product_id.'.$i] = 'required|unique:stock_details,product_id,NULL,id,deleted_at,NULL';
            $fieldArray['brand.'.$i] = 'required|unique:stock_details,brand'.','.'id,deleted_at';
            $fieldArray['model.'.$i] = 'required|unique:stock_details,model'.','.'id,deleted_at';
            $fieldArray['unit_id.'.$i] = 'required|unique:stock_details,unit_id,NULL,id,deleted_at,NULL';
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
                            'product_id' => $this->product_id,
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
}
