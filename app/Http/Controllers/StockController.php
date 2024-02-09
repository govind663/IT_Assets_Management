<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Catagories;
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
        $vendos = Vendor::select('company_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $catagories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $products = Product::select('name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $units = Unit::select('unit_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('stocks.create', ['vendors' => $vendos,'catagories' => $catagories, 'products' => $products, 'units' => $units ]);
    }

    public function store(StockRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            Stock::create($data);
            return redirect()->route('stocks.index')->with('message','Stock created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Stock $stocks, $id)
    {
        $stocks = Stock::findOrFail($id);
        // dd($stocks);
        return view('stocks.view')->with(['stocks' => $stocks]);
    }

    public function edit(Stock $stocks, $id)
    {
        $stocks = Stock::findOrFail($id);
        // dd($stocks);
        return view('stocks.edit' )->with([ 'stocks'=>$stocks ]);
    }

    public function update(StockRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $catagories= Stock::findOrFail($id);
            $catagories->update($data);
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
            $catagories = Stock::findOrFail($id);
            $catagories->update();

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
                                ->get(["name", "id", 'brand', 'mobile_no']);

        return response()->json($data);
    }
}
