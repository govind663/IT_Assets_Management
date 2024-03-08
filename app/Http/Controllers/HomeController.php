<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RequestMaterialProduct;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // count total user
        $total_user = User::count();

        // count total stock_details  that have stock_id is present in stock
        $stockDetailsWithStockId = DB::table('stock_details')
                                    ->join('stocks', 'stock_details.stock_id', '=', 'stocks.id')
                                    ->whereNotNull('stock_details.stock_id')
                                    ->get()
                                    ->count();

        // count total request_material_products  that have new_material_id is present in stock
        $requestMaterialProductsCount = DB::table('request_material_products')
                                    ->join('new_materials', 'request_material_products.new_material_id', '=', 'new_materials.id')
                                    ->whereNotNull('request_material_products.new_material_id')
                                    ->get()
                                    ->count();

        // total products count
        $productCount = Product::count();

        // total vendors count
        $vendorsCount = Vendor::count();
        return view('dashboard',
        ['total_user' => $total_user,
         'requestMaterialProductsCount' => $requestMaterialProductsCount,
         'stockDetailsWithStockId' => $stockDetailsWithStockId,
         'productCount' => $productCount,
         'vendorsCount' => $vendorsCount,
        ]);
    }
}
