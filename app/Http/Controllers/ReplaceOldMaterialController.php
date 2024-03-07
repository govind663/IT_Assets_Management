<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplaceOldMaterialRequest;
use App\Models\Department;
use App\Models\Product;
use App\Models\ReplaceOldMaterial;
use App\Models\RequestMaterialProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReplaceOldMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $replaceOldMaterial = ReplaceOldMaterial::with('department', 'product')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($replaceOldMaterial);

        // === newMaterials status
        $currentMaterialStatus  = ReplaceOldMaterial::whereNull('deleted_at')
                                               ->where('inserted_by', Auth::user()->id)
                                               ->orderByDesc('id')
                                               ->first( 'status' );
        // dd($currentMaterialStatus);
        if ( isset( $currentMaterialStatus ) && !is_null( $currentMaterialStatus->status ) ) {
            $materialStatus = $currentMaterialStatus->status;
        } else {
            $materialStatus =  "null";
        };

        return view('replace-old-material.index', ['replaceOldMaterial' => $replaceOldMaterial, 'materialStatus' => $materialStatus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // === get product_code in RequestMaterialProduct
        $products = Product::select('id','name')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($productCode);

        return view('replace-old-material.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReplaceOldMaterialRequest $request)
    {
        $request->validated();
        try {
            // $replaceOldMaterial = ReplaceOldMaterial::create($data);
            $replaceOldMaterial = new ReplaceOldMaterial();
            $replaceOldMaterial->serial_no_id = $request->get('serial_no_id');
            $replaceOldMaterial->product_id = $request->get('product_id');
            $replaceOldMaterial->department_id = $request->get('department_id');
            $replaceOldMaterial->work_order_no = $request->get('work_order_no');
            $replaceOldMaterial->order_dt = Carbon::parse($request->get('order_dt'))->format("Y-m-d");
            $replaceOldMaterial->supply_dt = Carbon::parse($request->get('supply_dt'))->format("Y-m-d");
            $replaceOldMaterial->return_dt = Carbon::parse($request->get('return_dt'))->format("Y-m-d");
            $replaceOldMaterial->reason  = $request->get('reason');
            $replaceOldMaterial->inserted_by = Auth::user()->id;
            $replaceOldMaterial->inserted_at = Carbon::now();
            $replaceOldMaterial->save();

            // ==== Generate Replace Product Code
            $unique_id = "PMC/PRD/" . date("Y") . "/" . str_pad($replaceOldMaterial ->id, 4, '0', STR_PAD_LEFT) . "-" . substr(strtoupper( md5(uniqid(rand()))),  0, 6 );
            $update = [
                'replaceRequestID' => $unique_id,
            ];
            ReplaceOldMaterial::where('id', $replaceOldMaterial->id)->update($update);

            return redirect()->route('replace-old-material.index')->with('message','Material created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $replaceOldMaterial = ReplaceOldMaterial::findOrFail($id)->with('department', 'product')->whereNull('deleted_at')->orderBy('id', 'desc')->first();
        // dd($replaceOldMaterial);

        return view('replace-old-material.view')->with(['replaceOldMaterial' => $replaceOldMaterial]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $replaceOldMaterial = ReplaceOldMaterial::findOrFail($id);
        $department = Department::select('dept_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $products = Product::select('name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('replace-old-material.edit')->with(['replaceOldMaterial' => $replaceOldMaterial, 'department' => $department, 'products' => $products, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReplaceOldMaterialRequest $request, string $id)
    {
        $request->validated();
        try {
            $replaceOldMaterial = ReplaceOldMaterial::findOrFail($id);
            $replaceOldMaterial->serial_no_id = $request->get('serial_no_id');
            $replaceOldMaterial->product_id = $request->get('product_id');
            $replaceOldMaterial->department_id = $request->get('department_id');
            $replaceOldMaterial->work_order_no = $request->get('work_order_no');
            $replaceOldMaterial->order_dt = Carbon::parse($request->get('order_dt'))->format("Y-m-d");
            $replaceOldMaterial->supply_dt = Carbon::parse($request->get('supply_dt'))->format("Y-m-d");
            $replaceOldMaterial->return_dt = Carbon::parse($request->get('return_dt'))->format("Y-m-d");
            $replaceOldMaterial->reason  = $request->get('reason');
            $replaceOldMaterial->modified_by = Auth::user()->id;
            $replaceOldMaterial->modified_at = Carbon::now();
            $replaceOldMaterial->update();

            return redirect()->route('replace-old-material.index')->with('message', 'Material updated Successfully!');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $replaceOldMaterial = ReplaceOldMaterial::where('id',$id)->update($data);

            return redirect()->route('replace-old-material.index')->with('message','Material has been deleted successfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    //=== fetchOrders
    public  function fetchOrders(Request $request)
    {
        $data['orderDetails'] = RequestMaterialProduct::select('request_material_products.product_code', 'new_materials.requested_at', 'stocks.inward_dt', 'stocks.work_order_no')
                                        ->leftJoin('new_materials', 'new_materials.id', '=', 'request_material_products.new_material_id')
                                        ->leftJoin('stocks', 'stocks.id', '=', 'request_material_products.stock_id')
                                        ->where('request_material_products.product_id', $request->product_id)
                                        ->whereNull('stocks.deleted_at')
                                        ->whereNull('request_material_products.deleted_at')
                                        ->orderBy('request_material_products.id', 'desc')
                                        ->get();
        return response()->json($data);
    }
}
