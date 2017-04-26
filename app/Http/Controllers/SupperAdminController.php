<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class SupperAdminController extends Controller {

    public function auth_check() {
        $admin_id = Session::get('admin_id');
        if ($admin_id == NULL) {
            Redirect::to('/admin')->send();
        }
    }

    public function dashboard() {
        $this->auth_check();
        $admin_index = view('admin.pages.admin_index');
        return view('admin.admin')->with('main_content', $admin_index);
    }

    public function add_category() {
        $this->auth_check();
        $add_category = view('admin.pages.add_category');
        return view('admin.admin')->with('main_content', $add_category);
    }

    public function save_category(Request $request) {

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;
        date_default_timezone_set('Asia/Dhaka');
        $data['created_at'] = date('Y-m-d h:i:s');
        DB::table('tbl_category')->insert($data);
        Session::put('message', 'Category added Succesfully !!');
        return Redirect::to('/add-category');
    }

    public function add_manufacturer() {
        $this->auth_check();
        $add_manufacturer = view('admin.pages.add_manufacturer');
        return view('admin.admin')->with('main_content', $add_manufacturer);
    }

    public function add_product() {
        $this->auth_check();
        $all_published_category = DB::table('tbl_category')
                                    ->where('publication_status', 1)
                                    ->get();
        $all_published_manufacturer = DB::table('tbl_manufacturer')
                                    ->where('publication_status', 1)
                                    ->get();
        $add_product = view('admin.pages.add_product')
                        ->with('all_published_category',$all_published_category)
                        ->with('all_published_manufacturer',$all_published_manufacturer);
        return view('admin.admin')->with('main_content', $add_product);
    }
    
    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacturer_id'] = $request->manufacturer_id;
        $data['product_old_price'] = $request->product_old_price;
        $data['product_new_price'] = $request->product_new_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['publication_status'] = $request->publication_status;
        if($request->is_featured == 'on'){
            $data['is_featured'] = 1;
        }else{
            $data['is_featured'] = 0;
        }
        
        $image = $request->file(['product_image']);
        if($image){
            $image_name = str_random(20);
            $extn = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$extn;
            $upload_path = "public/product_images/";
            $image_url = $upload_path.$image_full_name;
            $moved = $image->move($upload_path,$image_full_name);
            if($moved){
                $data['product_image'] = $image_url;
                DB::table('tbl_product')
                        ->insert($data);
                Session::put('message', 'Product added Succesfully !!');
                return Redirect::to('/add-product');
            }
            else{
                $error = $image->getErrorMessage();
                echo '<pre>';
                print_r($error);
            }
        }else{
            DB::table('tbl_product')
                        ->insert($data);
                Session::put('message', 'Product added Succesfully !!');
                return Redirect::to('/add-product');
        }
                
        
        
        
    }

    public function manage_category() {
        $this->auth_check();
        $all_category = DB::table('tbl_category')->get();
        $manage_category = view('admin.pages.manage_category')->with('all_category', $all_category);
        return view('admin.admin')->with('main_content', $manage_category);
    }

    public function save_manufacturer(Request $request) {
        $data = array();
        $data['manufacturer_name'] = $request->manufacturer_name;
        $data['manufacturer_description'] = $request->manufacturer_description;

        $data['publication_status'] = $request->publication_status;
        date_default_timezone_set('Asia/Dhaka');
        $data['created_at'] = date('Y-m-d h-i-s');

        $image = $request->file(['manufacturer_image']);
        if ($image) {
            $image_name = str_random(20);
            $image_extention = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $image_extention;
            $upload_path = "public/manufacturer_images/";
            $image_url = $upload_path . $image_full_name;
            $moved = $image->move($upload_path, $image_full_name);
            if ($moved) {
                $data['manufacturer_image'] = $image_url;
                DB::table('tbl_manufacturer')->insert($data);
                Session::put('message', 'Manufacturer added Succesfully !!');
                return Redirect::to('/add-manufacturer');
            } else {
                Session::put('message', 'Error in Image Upload !!');
                return Redirect::to('/add-manufacturer');
            }
        } else {
            $data['manufacturer_image'] = $image_url;
            DB::table('tbl_manufacturer')->insert($data);
            Session::put('message', 'Manufacturer added Succesfully !!');
            return Redirect::to('/add-manufacturer');
        }
    }

    public function manage_manufacturer() {
        $this->auth_check();
        $all_manufacturer = DB::table('tbl_manufacturer')->get();

        $manage_manufacturer = view('admin.pages.manage_manufacturer')->with('all_manufacturer', $all_manufacturer);
        return view('admin.admin')->with('main_content', $manage_manufacturer);
    }

    public function unpublished_manufacturer($id) {
        DB::table('tbl_manufacturer')
                ->where('manufacturer_id', $id)
                ->update(['publication_status' => 0]);
        return redirect('/manage-manufacturer');
    }

    public function published_manufacturer($id) {
        DB::table('tbl_manufacturer')
                ->where('manufacturer_id', $id)
                ->update(['publication_status' => 1]);
        return redirect('/manage-manufacturer');
    }

    public function edit_manufacturer($id) {
        $this->auth_check();
        $manufacturer_info = DB::table('tbl_manufacturer')
                ->where('manufacturer_id', $id)
                ->first();
        $edit_manufacturer = view('admin.pages.edit_manufacturer')
                ->with('manufacturer_info', $manufacturer_info);
        return view('admin.admin')->with('main_content', $edit_manufacturer);
    }

    public function update_manufacturer(Request $request) {
        $data = array();
        $data['manufacturer_id'] = $request->manufacturer_id;
        $data['manufacturer_name'] = $request->manufacturer_name;
        $data['manufacturer_description'] = $request->manufacturer_description;
        $data['publication_status'] = $request->publication_status;
        date_default_timezone_set('Asia/Dhaka');
        $data['updated_at'] = date('Y-m-d h:i:s');

        $image = $request->file(['manufacturer_image']);
        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = "public/manufacturer_images/";
            $image_url = $upload_path . $image_full_name;
            $moved = $image->move($upload_path, $image_full_name);
            if ($moved) {
                $data['manufacturer_image'] = $image_url;
                DB::table('tbl_manufacturer')
                        ->where('manufacturer_id', $data['manufacturer_id'])
                        ->update($data);
                $manufacturer_old_image_path = $request->manufacturer_old_image_path;
                unlink($manufacturer_old_image_path);
                return redirect('/manage-manufacturer');
            }
        } else {
            DB::table('tbl_manufacturer')
                    ->where('manufacturer_id', $data['manufacturer_id'])
                    ->update($data);
            return redirect('/manage-manufacturer');
        }
    }

    public function delete_manufacturer($id) {
        $manufacturer_info = DB::table('tbl_manufacturer')
                ->where('manufacturer_id', $id)
                ->first();
        DB::table('tbl_manufacturer')
                ->where('manufacturer_id', $id)
                ->delete();
        $manufacturer_image = $manufacturer_info->manufacturer_image;
        unlink($manufacturer_image);
        return redirect('/manage-manufacturer');
    }

    public function unpublished_category($id) {
        DB::table('tbl_category')
                ->where('category_id', $id)
                ->update(['publication_status' => 0]);
        return Redirect::to('/manage-category');
    }

    public function published_category($id) {
        DB::table('tbl_category')
                ->where('category_id', $id)
                ->update(['publication_status' => 1]);
        return Redirect::to('/manage-category');
    }

    public function edit_category($id) {
        $this->auth_check();
        $category_info = DB::table('tbl_category')->where('category_id', $id)->first();

        $edit_category = view('admin.pages.edit_category')->with('category_info', $category_info);
        return view('admin.admin')->with('main_content', $edit_category);
    }

    public function update_category(Request $request) {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;
        date_default_timezone_set('Asia/Dhaka');
        $data['updated_at'] = date('Y-m-d h:i:s');
        DB::table('tbl_category')
                ->where('category_id', $data['category_id'])
                ->update($data);
        return Redirect::to('/manage-category');
    }

    public function delete_category($id) {
        DB::table('tbl_category')
                ->where('category_id', $id)
                ->delete();
        return redirect('/manage-category');
    }

    public function manage_product() {
        $this->auth_check();
        $all_product = DB::table('tbl_product')
                ->get();
        $manage_product = view('admin.pages.manage_product')
                ->with('all_product', $all_product);
        return view('admin.admin')->with('main_content', $manage_product);
    }
    public function unpublished_product($id){
        DB::table('tbl_product')
                ->where('product_id', $id)
                ->update(['publication_status' => 0]);
        return Redirect::to('/manage-product');
    }
    public function published_product($id){
        DB::table('tbl_product')
                ->where('product_id', $id)
                ->update(['publication_status' => 1]);
        return Redirect::to('/manage-product');
    }
    public function edit_product($id){
        $this->auth_check();
        $product_info = DB::table('tbl_product')
                ->where('product_id', $id)
                ->first();
        $all_published_category = DB::table('tbl_category')
                                    ->where('publication_status', 1)
                                    ->get();
        $all_published_manufacturer = DB::table('tbl_manufacturer')
                                    ->where('publication_status', 1)
                                    ->get();
        $edit_product = view('admin.pages.edit_product')
                ->with('product_info', $product_info)
                ->with('all_published_category',$all_published_category)
                ->with('all_published_manufacturer',$all_published_manufacturer);
        return view('admin.admin')->with('main_content', $edit_product);
    }
    public function update_product(Request $request){
        $product_id = $request->product_id;
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacturer_id'] = $request->manufacturer_id;
        $data['product_old_price'] = $request->product_old_price;
        $data['product_new_price'] = $request->product_new_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['publication_status'] = $request->publication_status;
        if($request->is_featured == 'on'){
            $data['is_featured'] = 1;
        }else{
            $data['is_featured'] = 0;
        }
        
        $image = $request->file(['product_image']);
        if($image){
            $image_name = str_random(20);
            $extn = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$extn;
            $upload_path = "public/product_images/";
            $image_url = $upload_path.$image_full_name;
            $moved = $image->move($upload_path,$image_full_name);
            if($moved){
                $data['product_image'] = $image_url;
                DB::table('tbl_product')
                        ->where('product_id',$product_id)
                        ->update($data);
                $product_old_image_path = $request->product_old_image_path;
                unlink($product_old_image_path);
                return Redirect::to('/manage-product');
            }
            else{
                $error = $image->getErrorMessage();
                echo '<pre>';
                print_r($error);
            }
        }else{
            DB::table('tbl_product')
                        ->where('product_id',$product_id)
                        ->update($data);
            return Redirect::to('/manage-product');
        }
    }

    public function delete_product($id){
        $product_info = DB::table('tbl_product')
                ->where('product_id', $id)
                ->first();
        DB::table('tbl_product')
                ->where('product_id', $id)
                ->delete();
        $product_image = $product_info->product_image;
        if($product_image){
            unlink($product_image);
        }
        return redirect('/manage-product');
    }

    public function logout() {
        Session::put('admin_id', '');
        Session::put('admin_name', '');
        Session::put('message', 'You Are Successfully Loged Out');
        return Redirect::to('/admin');
    }

}
