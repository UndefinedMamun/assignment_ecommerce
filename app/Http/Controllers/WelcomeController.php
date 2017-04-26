<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider_page = view('pages.slider');
        $latest_product_page = view('pages.latest_product');
        return view('master')
            ->with('slider_content',$slider_page)
            ->with('main_content',$latest_product_page);
    }
    public function category_product($id){
        $products_by_category_id = DB::table('tbl_product')
                ->where('category_id', $id)
                ->where('publication_status', 1)
                ->get();
        $category_product = view('pages.category_products')
                ->with('category_products', $products_by_category_id);
        return view('master')
            ->with('main_content', $category_product);
    }
    
    public function manufacturer_product($manufacturer_name){
        $manufacturer_info = DB::table('tbl_manufacturer')
                ->where('manufacturer_name',$manufacturer_name)
                ->first();
        $manufacturer_id = $manufacturer_info->manufacturer_id;
        $products_by_manufacturer_id = DB::table('tbl_product')
                ->where('manufacturer_id',$manufacturer_id)
                ->where('publication_status',1)
                ->get();
        $manufacturer_products_page = view('pages.manufacturer_products')
                    ->with('manufacturer_products',$products_by_manufacturer_id);
        return view('master')
                ->with('main_content',$manufacturer_products_page);
    }
    public function product_details($product_name) {
        $product_info=DB::table('tbl_product')
                                    ->join('tbl_manufacturer', 'tbl_product.manufacturer_id', '=', 'tbl_manufacturer.manufacturer_id')
                                    ->select('tbl_product.*', 'tbl_manufacturer.*')
                                    ->where('product_name',$product_name)
                                    ->first();
//        echo '<pre>';
//        print_r($product_info);
//        exit();
        
        $product_details = view('pages.product_details')
                                        ->with('product_info',$product_info);
        return view('master')
                        ->with('main_content', $product_details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
