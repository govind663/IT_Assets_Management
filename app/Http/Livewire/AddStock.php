<?php

namespace App\Http\Livewire;

use App\Http\Requests\StockRequest;
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

    //  Add new form fields to the loop
    public function submitApplication()
    {
        $this->addValidate();

        // ===== store  in DB =======
        $vendors = Stock::create([
            'vendor_id' => $this->vendor_id ?: null,
            'inward_dt' => date("Y-m-d", strtotime($this->inward_dt)),
            'voucher_no' =>  $this->voucher_no ?: null,
            'work_order_no' =>  $this->work_order_no ?: null,
            'inserted_by' => Auth::user()->id,
            'inserted_at' => Carbon::now()
        ]);

        // ==== Generate Invoce Number
        $unique_id = "PMC-INV" . sprintf("%06d", abs((int)$vendors->id + 1))  . "/" . date("Y");
        $update = [
            'invoice_no' => $unique_id,
        ];
        Stock::where('id', $vendors->id)->update($update);

        //  === save product details into stock_details table.
        foreach ($this->categories_id as $key=>$value) :
            if (!empty($value)) :
                StockDetail::create([
                    "stock_id" => $vendors->id,
                    "catagories_id" =>  $value,
                    "product_id" => $this->product_id[$key],
                    "brand" => $this->brand[$key],
                    "model" => $this->model[$key],
                    "unit_id" => $this->unit_id[$key],
                    "warranty_dt" =>  isset($this->warranty_dt[$key])?date("Y-m-d",strtotime($this->warranty_dt[$key])):"",
                    "quantity" =>  $this->quantity[$key],
                    "inserted_by" => Auth::user()->id,
                    "inserted_at" => Carbon::now(),
                ]);
            endif;
            //  Reset all field after add one time
            // $this->reset(['categories_id', 'product_id','brand','model','unit_id', 'warranty_dt','quantity']);

            // ==== Generate  unique SKU for each Product
            $sku_id = "PMC_SKU-" . substr(md5(time()), rand(0, 26), 6) .  sprintf("%06d", $this->hidden_stock_detail_id);
            $skuUpdate = [
                "product_code" => $sku_id,
            ];
            StockDetail::where('product_id', $this->product_id[$key])->update($skuUpdate);
        endforeach;

        return redirect()->route('stocks.index')->with('message','Stock created successfully');;
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
            $fieldArray['warranty_dt.'.$i] = 'required';
            $fieldArray['quantity.'.$i] = 'required';

            $messageArray['categories_id.'.$i . '.required'] = 'Please select any category';
            $messageArray['product_id.' . $i . '.required'] = 'Please select a product';
            $messageArray['brand.' . $i . '.required'] = 'Brand is required';
            $messageArray['model.' . $i . '.required'] = "Model is required";
            $messageArray['unit_id.' . $i . '.required'] = 'Unit is required';
            $messageArray['warranty_dt.' . $i . '.required'] = 'Warranty Date is required';
            $messageArray['quantity.' . $i . '.required'] = 'Quantity is required';
        }

        $fieldArray['vendor_id'] = 'required|exists:vendors,id';
        $fieldArray['inward_dt'] = 'required| date';
        $fieldArray['voucher_no'] = 'required|max:255';
        $fieldArray['work_order_no'] = 'required|max:255';

        $messageArray['vendor_id.required'] = 'Vendor name is required';
        $messageArray['inward_dt.required'] = 'Inword Stock Date  is required';
        $messageArray['inward_dt.date'] = 'Inward Date must be  valid date format';
        $messageArray['voucher_no.required'] = 'Voucher Number is required';
        $messageArray['work_order_no.required'] = 'Work Order Number is required';

        $validator = Validator::make([
                            'categories_id' => $this->categories_id,
                            'product_id' => $this->product_id,
                            'brand' => $this->brand,
                            'model' => $this->model,
                            'unit_id' => $this->unit_id,
                            'warranty_dt' => $this->warranty_dt,
                            'quantity' => $this->quantity,
                            'vendor_id' => $this->vendor_id,
                            'inward_dt' => $this->inward_dt,
                            'voucher_no' => $this->voucher_no,
                            'work_order_no' => $this->work_order_no,
                        ], $fieldArray, $messageArray );

        $validator->validate();
    }
}
