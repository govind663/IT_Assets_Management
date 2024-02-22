<?php

namespace App\Http\Livewire;

use App\Models\Catagories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockDetail;
use App\Models\Unit;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ViewStock extends Component
{
    // COPONENT VARIABLES
    public $stockIds;
    public $productId, $unitId;
    public $categoryRows;
    public $loop_products;
    public $loop_units;
    public $formCounts = 1;
    public $show;
    public $rowsCount;

    // FORM MODELS
    public $vendor_id;
    public $inward_dt;
    public $voucher_no;
    public $categories_id;
    public $product_id;
    public $brand;
    public $model;
    public $warranty_dt;
    public $quantity;
    public $unit_id;

    //  SHOW/HIDE Form
    public $work_order_no =  '';


    public function render()
    {
        $categories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $vendors = Vendor::select('company_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        //===  request idwhen edit  stock ===//
        $stockIds = request()->stock;

        // ====  get the data for show in form when editing a record=====//
        $stocks = Stock::findOrFail($stockIds);
        $stocksDetails = StockDetail::with('catagory', 'product', 'unit')
                                    ->where('stock_id', $stockIds)
                                    ->whereNull('deleted_at')
                                    ->orderBy('id', 'desc')
                                    ->get();

        $this->stockIds = $stocks['id'];
        $this->vendor_id = $stocks['vendor_id'];
        $this->inward_dt = Carbon::parse($stocks['inward_dt'])->format('Y-m-d');
        $this->voucher_no = $stocks['voucher_no'];
        $this->work_order_no = $stocks['work_order_no'];

        // dd($stocksDetails);

        // === display  $stocksDetails all input / dropdown value base on   $stocksDetails[0] values. ===//
        foreach ($stocksDetails as $key => $item) {
            // dd($item);
            $this->categories_id[$key] = $item['catagories_id'];
            $this->productId[$key]= $item['product_id'] ;
            if(isset($this->productId[$key]))
            {
                $this->loop_products[$key] =  Product::select('id','name')
                                                    ->where('catagories_id' ,$this->categories_id [$key])
                                                    ->where('id' , $this->productId [$key])
                                                    ->orderBy('id', 'asc')
                                                    ->whereNull('deleted_at')
                                                    ->get();
            }else{
                $this->loop_products[$key] =  [];
            }
            $this->brand[$key] = $item['brand'];
            $this->model[$key] = $item['model'];
            $this->unitId[$key]  = $item['unit_id'];
            if(isset($this->unitId[$key]))
            {
                $this->loop_units[$key]  = Unit::select('id','unit_name')
                                                ->where('id', $this->unitId[$key])
                                                ->orderBy('id', 'asc')
                                                ->whereNull('deleted_at')
                                                ->get();
            }else{
                $this->loop_units[$key]   =  [];
            }
            $this->warranty_dt[$key] = Carbon::parse($item['warranty_dt'])->format('Y-m-d');
            $this->quantity[$key] = $item['quantity'];
        }

        if ($this->work_order_no) {
            $this->show = true;
            $this->displayForm(true);
        } else {
            $this->resetForm();
            $this->displayForm(false);
        }
        return view('livewire.view-stock')->with([
            'vendors' => $vendors,
            'categories' => $categories,
            'stocks' => $stocks,
            'stocksDetails' => $stocksDetails
        ]);
    }


    // === show or Hide the form =======
    public function displayForm($value)
    {
        $this->show = $value;
    }

    // ===== Show vlue in   row base on category ====
    public function categoryShowRow($row){
        if (!isset($this->categoryRows[$row->cataglogy_id])){
            $this->categoryRows[$row->cataglogy_id] = false;
            }

        $this->categoryRows[$row->cataglogy_id]  = true;
        $this->rowsCount++;
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

    public function work_order_no($event)
    {
        if($event){
            $this->work_order_no = $this->work_order_no;
        }
    }
}
