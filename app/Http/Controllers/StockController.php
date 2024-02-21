<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Catagories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockDetail;
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

        return view('stocks.index', ['stocks' => $stocks]);
    }

    public function create()
    {
        return view('stocks.create');
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
        // == get stock & stockdetails
        $stocks = StockDetail::with('stock', 'catagory', 'product', 'unit')
                                ->whereNull('deleted_at')
                                ->orderBy('id', 'desc')
                                ->get();
        // dd($stocks);
        return view('stocks.edit' )->with([ 'stocks'=>$stocks]);
    }

    public function update(Request $request, $id)
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
}
