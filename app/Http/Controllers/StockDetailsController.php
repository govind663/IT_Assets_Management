<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Catagories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockDetail;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockDetailsController extends Controller
{
    public function index()
    {
        $stock_details = StockDetail::with('stock', 'catagory', 'product', 'unit')
                               ->whereNull('deleted_at')
                               ->orderBy('id', 'desc')
                               ->get();
        // dd($stock_details);

        return view('stock_details.index', ['stock_details' => $stock_details]);
    }

    public function create()
    {
        $stocks = Stock::select('work_order_no', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $catagories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('stock_details.create', ['stocks' => $stocks, 'catagories' => $catagories ]);
    }

    public function store(StockRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            $StockDetail = StockDetail::create($data);

            // ==== Generate Product Code
            $unique_id = "PMC/" . sprintf("%06d", abs((int)$StockDetail->id + 1))  . "/" . date("Y");
            $update = [
                'product_code' => $unique_id,
            ];
            Stock::where('id', $StockDetail->id)->update($update);

            return redirect()->route('stock_details.index')->with('message','Stock Details created successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }
}
