<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Catagories;
use App\Models\Department;
use App\Models\NewMaterial;
use App\Models\Product;
use App\Models\RequestMaterialProduct;
use App\Models\Unit;
use Livewire\WithFileUploads;

class ViewNewMaterial extends Component
{
    use WithFileUploads;

    // COPONENT VARIABLES
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

    // Show  or Hide forms
    public $fileUploaded = false;

    public function render()
    {
        $departments = Department::select('dept_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $categories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('livewire.view-new-material', ['departments' => $departments, 'categories'=> $categories]);
    }


    //  INITIALIZE COMPONENT
    public function mount()
    {
        $this->data = NewMaterial::find(request()->request_new_material) ?? NewMaterial::first();
        $this->materialDoc = NewMaterial::find(request()->request_new_material) ?? NewMaterial::first()->pluck('material_doc');
        $this->materialID = NewMaterial::find(request()->request_new_material)->toArray();
        $this->product_code = RequestMaterialProduct::where('new_material_id', request()->request_new_material)
                                ->value('product_code');

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
}
