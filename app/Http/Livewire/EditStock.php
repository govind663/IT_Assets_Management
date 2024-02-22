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

class EditStock extends Component
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

        return view('livewire.edit-stock')->with([
            'vendors' => $vendors,
            'categories' => $categories
        ]);
    }



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


    // === show or Hide the form =======
    public function displayForm($value)
    {
        $this->show = $value;
    }

    //  Update form fields to the loop
    public function submitApplication()
    {
        $this->addValidate();
        $stock = Stock::findOrFail($this->stock['id']);
        $stock->update([
            'voucher_no' => $this->voucher_no ?: null,
            'work_order_no'=>$this->work_order_no ?: null,
            'inward_dt' =>  date('Y-m-d', strtotime($this->inward_dt)),
            'work_order_no' =>  $this->work_order_no ?: null,
            'modified_by'  => Auth::user()->id,
            'modified_at' => Carbon::now()
        ]);

        // save product details into stock_details table
        foreach ($this->product as $key=>$val){
            $data = [
                'stock_id'     => $stock->id ,
                "category_id" => $val["category"],
                'product_id ' => $val['product_id '],
                'brand' => $val['brand'],
                'model' => $val['model'],
                'unit_id' => $val['unit_id'],
                'warranty_dt' =>  date("Y-m-d",strtotime($val['warranty_dt'])) ?? null,
                'quantity' => $val['quantity'],
                'modified_by'  => Auth::user()->id,
                'modified_at' => Carbon::now()
            ];
            if(isset($this->stockDetailId[$key])){
                $data['id'] = $this->stockDetailId[$key];
                StockDetail::where('id',$this->stockDetailId[$key])
                            ->where('product_code', $this->product_code[$key])
                            ->update($data);
            }else{
                $data['inserted_by'] = Auth::user()->id ;
                $data['inserted_at'] = Carbon::now();
                StockDetail::create($data);
            }
        }

        return redirect()->route('stocks.index')->with('message','Stock Updated Successfully');;
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
            $this->loop_products[$this->formCounts] = $this->loop_products[$this->formCounts-1];
            $this->loop_units[$this->formCounts] = $this->loop_units[$this->formCounts-1];
        }
    }

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
            unset($this->warranty_dt[$this->formCounts]);
            unset($this->quantity[$this->formCounts]);
            --$this->formCounts;

            //  Reset the last form to have all data filled in again.
            $lastFormKey = $this->formCounts - 1;
            $this->categories_id[$lastFormKey] = $this->categories_id[$this->formCounts];
            $this->product_id[$lastFormKey] = $this->product_id[$this->formCounts];
            $this->brand[$lastFormKey] = $this->brand[$this->formCounts];
            $this->model[$lastFormKey] = $this->model[$this->formCounts];
            $this->unit_id[$lastFormKey] = $this->unit_id[$this->formCounts];
            $this->warranty_dt[$lastFormKey] = $this->warranty_dt[$this->formCounts];
            $this->quantity[ $lastFormKey ]=  "1";


        }
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
            $fieldArray['brand.'.$i] = 'required';
            $fieldArray['model.'.$i] = 'required';
            $fieldArray['unit_id.'.$i] = 'required';
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
