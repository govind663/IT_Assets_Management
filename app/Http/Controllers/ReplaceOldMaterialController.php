<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use App\Models\RequestMaterialProduct;
use App\Models\StockDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplaceOldMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('replace-old-material.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //=== fetchOrders
    public  function fetchOrders(Request $request){
        $data['orderDetails'] = RequestMaterialProduct::select('request_material_products.id', 'request_material_products.product_code')
                                        ->whereIn('request_material_products.product_id', $request->product_id)
                                        ->whereNull('request_material_products.deleted_at')
                                        ->orderBy('request_material_products.id', 'desc')
                                        ->get();

        return response()->json($data);
    }
}
