<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Unit;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('vendor')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($stocks);

        return view('stocks.index', ['stocks' => $stocks]);
    }

    public function create()
    {
        $vendors = Vendor::select('company_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('stocks.create', ['vendors' => $vendors ]);
    }

    public function store(StockRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            $vendors = Stock::create($data);

            // ==== Generate Invoce Number
            $unique_id = "PMC/STOCK" . sprintf("%06d", abs((int)$vendors->id + 1))  . "/" . date("Y");
            $update = [
                'invoice_no' => $unique_id,
            ];
            Stock::where('id', $vendors->id)->update($update);

            return redirect()->route('stocks.index')->with('message','Stock created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Stock $stocks, $id)
    {
        $stocks = Stock::findOrFail($id)->with('vendor')->whereNull('deleted_at')->orderByDesc('id')->first();
        // dd($stocks);
        return view('stocks.view')->with(['stocks' => $stocks]);
    }

    public function edit(Stock $stocks, $id)
    {
        $stocks = Stock::findOrFail($id);
        $vendos = Vendor::select('company_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        // dd($stocks);
        return view('stocks.edit' )->with([ 'stocks'=>$stocks, 'vendors'=>$vendos ]);
    }

    public function update(StockRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $stocks= Stock::findOrFail($id);
            $stocks->update($data);
            return redirect()->route('stocks.index')->with('message', 'Stocks updated Successfully!');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $stocks = Stock::findOrFail($id);
            $stocks->update($data);

            return redirect()->route('stocks.index')->with('message','Stocks Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchProducts(Request $request)
    {
        $data['products'] = Product::where("catagories_id", $request->catagories_id)
                                ->whereNull('deleted_at')
                                ->orderByDesc('id')
                                ->get(["id", "name", 'brand', 'model_no', 'unit_id']);
        // dd($data['products']);
        $unitID = $data['products']->pluck('unit_id')->toArray();
        if(!empty($unitID)){
            $data['units'] = Unit::select(['id', 'unit_name'])->whereIn('id',$unitID)->get();
        }else{
            $data['units']= [];
        }
        return response()->json($data);
    }
}
