<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockDetailsRequest;
use App\Models\Catagories;
use App\Models\Stock;
use App\Models\StockDetail;
use Carbon\Carbon;
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

    public function store(StockDetailsRequest $request, )
    {
        $StockDetail = $request->validated();

        $StockDetail = new StockDetail();
            $StockDetail->work_order_no = $request->get('work_order_no');
            $StockDetail->catagories_id = $request->get('catagories_id');
            $StockDetail->product_id = $request->get('product_id');
            $StockDetail->brand = $request->get('brand');
            $StockDetail->model = $request->get('model');
            $StockDetail->unit_id = $request->get('unit_id');
            $StockDetail->warranty_dt = date( "Y-m-d", strtotime($request->get('warranty_dt')));
            $StockDetail->quantity = $request->get('quantity');
            $StockDetail->inserted_at = Carbon::now();
            $StockDetail->inserted_by = Auth::user()->id;
            $StockDetail->save();

            // ==== Generate Product Code
            $unique_id = "PMC/" . sprintf("%06d", abs((int)$StockDetail->id + 1))  . "/" . date("Y");
            $update = [
                'product_code' => $unique_id,
            ];
            Stock::where('id', $StockDetail->id)->update($update);

            return redirect()->route('stock_details.index')->with('message','Stock Details created successfully');

        // try {
        //     $StockDetail = new StockDetail();
        //     $StockDetail->work_order_no = $request->get('work_order_no');
        //     $StockDetail->catagories_id = $request->get('catagories_id');
        //     $StockDetail->product_id = $request->get('product_id');
        //     $StockDetail->brand = $request->get('brand');
        //     $StockDetail->model = $request->get('model');
        //     $StockDetail->unit_id = $request->get('unit_id');
        //     $StockDetail->warranty_dt = $request->get('warranty_dt');
        //     $StockDetail->quantity = $request->get('quantity');
        //     $StockDetail->inserted_at = Carbon::now();
        //     $StockDetail->inserted_by = Auth::user()->id;
        //     $StockDetail->save();

        //     // ==== Generate Product Code
        //     $unique_id = "PMC/" . sprintf("%06d", abs((int)$StockDetail->id + 1))  . "/" . date("Y");
        //     $update = [
        //         'product_code' => $unique_id,
        //     ];
        //     Stock::where('id', $StockDetail->id)->update($update);

        //     return redirect()->route('stock_details.index')->with('message','Stock Details created successfully');

        // } catch(\Exception $ex){

        //     return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        // }
    }
}
