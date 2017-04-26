<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_to_cart(Request $request)
    {
        $qty = $request->qty;
        $id = $request->id;
        
        $product_info = DB::table('tbl_product')
                ->where('product_id', $id)
                ->first();
        $data = array();
        $data['id']=$product_info->product_id;
        $data['name']=$product_info->product_name;
        $data['qty']=$qty;
        $data['price']=$product_info->product_new_price;
        $data['options']['image']=$product_info->product_image;
        
        Cart::add($data);
        return Redirect::to('/show-cart');
    }
    public function show_cart(){
        $cart_veiw = view('pages.cart_view');
        return view('master')
            ->with('main_content', $cart_veiw);
    }
    
    public function remove_product_from_cart($id){
        
        $contents = Cart::content();
        foreach ($contents as $v_contents){
            if($v_contents->id == $id )
            {
                $rowId = $v_contents->rowId;
            }
        }
        Cart::remove($rowId);
        echo view('pages.ajax_cart_view');
    }
    public function update_qty($qty_id)
    {
        $data = explode('-',$qty_id);
        $qty = $data[0];
        $id = $data[1];
        $contents = Cart::content();
        foreach ($contents as $v_contents){
            if($v_contents->id == $id )
            {
                $rowId = $v_contents->rowId;
            }
        }
        Cart::update($rowId,$qty);
        echo view('pages.ajax_cart_view');
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
