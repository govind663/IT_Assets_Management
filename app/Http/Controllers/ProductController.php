<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Catagories;
use App\Models\Product;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('catagories', 'unit')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($products);

        return view('master.products.index')->with(['products' => $products]);
    }

    public function create()
    {
        $catagories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $unit = Unit::select('unit_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('master.products.create')->with([ 'catagories' => $catagories, 'unit' => $unit ]);
    }

    public function store(ProductRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        // $image = Image::make(public_path('storage/' . $request ->file('inputname')->hashName()))->fit(100, 100 );

        try {
            $products = Product::create($data);

            // ==== Generate Product Code
            $unique_id = "PMC/PRD/" . sprintf("%06d", abs((int)$products->id + 1))  . "/" . date("Y");
            $update = [
                'product_code' => $unique_id,
            ];
            Product::where('id', $products->id)->update($update);

            return redirect()->route('products.index')->with('message','Product created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Product $products, $id)
    {
        $products = Product::findOrFail($id)->with('catagories', 'unit')->whereNull('deleted_at')->orderByDesc('id')->first();
        // dd($products);
        return view('master.products.view')->with(['products' => $products]);
    }

    public function edit(Product $products, $id)
    {
        $products = Product::findOrFail($id);
        $catagories = Catagories::select('catagories_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $unit = Unit::select('unit_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        // dd($products);
        return view('master.products.edit' )->with([ 'products'=>$products, 'catagories' => $catagories, 'unit' => $unit ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $products = Product::findOrFail($id);
            $products->update($data);
            return redirect()->route('products.index')->with('message', 'Product updated Successfully!');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $products = Product::findOrFail($id);
            $products->update($data);

            return redirect()->route('products.index')->with('message','Product Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
