<?php

namespace App\Http\Livewire;

use App\Models\Catagories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockDetail;
use App\Models\Unit;
use App\Models\Vendor;
use Livewire\Component;

class ViewStock extends Component
{
    // PROP VARIABLE
    public $stock;

    // COPONENT VARIABLES
    public $vendor_id;
    public $inward_dt;
    public $voucher_no;
    public $loop_products;
    public $loop_units;
    public $formCounts = 1;
    public $show;
    public $add;

    // FORM MODELS
    public $hidden_stock_detail_id;
    public $product_code;
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

        return view('livewire.view-stock')->with(['vendors' => $vendors, 'categories' => $categories]);
    }

    //  INITIALIZE COMPONENT
    public function mount()
    {
        $this->stock = Stock::find(request()->stock)->toArray();

        $stocksDetails = StockDetail::with('catagory', 'product', 'unit')
                                    ->where('stock_id', $this->stock['id'])
                                    ->orderByDesc('id')
                                    ->get();

        foreach ($stocksDetails as $key => $stocksDetail)
        {
            $this->product_code[$key+1] = $stocksDetail['product_code'];
            $this->hidden_stock_detail_id[$key+1] = $stocksDetail['id'];
            $this->categories_id[$key+1] = $stocksDetail['catagories_id'];
            $this->product_id[$key+1] = $stocksDetail['product_id'];
            $this->brand[$key+1] = $stocksDetail['brand'];
            $this->model[$key+1] = $stocksDetail['model'];
            $this->warranty_dt[$key+1] = $stocksDetail['warranty_dt'];
            $this->quantity[$key+1] = $stocksDetail['quantity'];
            $this->unit_id[$key+1] = $stocksDetail['unit_id'];

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

        $this->vendor_id = $this->stock['vendor_id'];
        $this->inward_dt = $this->stock['inward_dt'];
        $this->voucher_no = $this->stock['voucher_no'];
        $this->work_order_no = $this->stock['work_order_no'];

        $this->formCounts = $stocksDetails->count();
    }

    public function work_order_no($event)
    {
        if($event){
            $this->work_order_no = $this->work_order_no;
        }
    }
}
