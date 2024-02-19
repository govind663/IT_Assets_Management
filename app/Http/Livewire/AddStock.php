<?php

namespace App\Http\Livewire;

use App\Models\Catagories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Unit;
use App\Models\Vendor;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddStock extends Component
{
    // COPONENT VARIABLES
    public $stockIds;
    public $vendorIds;
    public $categoryIds;
    public $loop_products;
    public $loop_units;
    public $formCounts = 1;

    // FORM MODELS
    public $vendor_id;
    public $categories_id;
    public $product_id;
    public $brand;
    public $model;
    public $unit_id;

    //  SHOW/HIDE Form
    public $workOrderNumber =  '';

    public function render()
    {
        $stocks = Stock::select('work_order_no', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $categories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $vendors = Vendor::select('company_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('livewire.add-stock')->with(['stocks'=> $stocks, 'vendors'=> $vendors, 'categories'=> $categories]);
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


    public function submitApplication()
    {
        // validation
        $this->validate([
            'vendor_id' => ['required'],
            'inward_dt' => ['required'],
            'voucher_no' => ['required'],
            'work_order_no' => ['required']
            ],[
                'vendor_id.required' => 'Vendor field is required.',
                'inward_dt.required' => 'Date field is required.',
                'voucher_no.required' => 'Voucher No. field is required.',
                'work_order_no.required'=>'Work Order Number is required.'
        ]);



    }


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

    public function updatedProductId($val, $key)
    {
        $prod = Product::where("id", $this->product_id[$key])
                        ->whereNull('deleted_at')
                        ->orderByDesc('id')
                        ->select("id", "name", 'unit_id', 'brand', 'mobile_no')->first();

        if($prod)
        {
            $this->brand[$key] = $prod->brand;
            $this->model[$key] = $prod->mobile_no;
            $this->unit_id[$key] = $prod->unit_id;

            $units = Unit::whereNull('deleted_at')->get();
            if($units)
            {
                $this->loop_units[$key] = $units;
            }
        }
    }


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
    public function remove()
    {
        if($this->formCounts > 1)
            $this->formCounts = --$this->formCounts;
    }

    public function workOrderNumber($event)
    {
        if($event){
            $this->workOrderNumber = $this->workOrderNumber;
        }
    }
}
