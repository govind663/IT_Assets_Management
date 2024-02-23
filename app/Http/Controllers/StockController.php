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
use Illuminate\Support\Facades\DB;

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

    public function show(Stock $stocks)
    {
        return view('stocks.view');
    }

    public function edit(String $id)
    {
        return view('stocks.edit' );
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            // delete  from table stockdetail first then stock
            DB::table("stock_details")->where("stock_id", "=",  $id)->update($data);
            DB::table("stocks")->where("id","=",$id)->update($data);

            return redirect()->route('stocks.index')->with('message','Stocks Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
