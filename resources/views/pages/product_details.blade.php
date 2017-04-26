@extends('master')
@section('main_content')
<div id="content_holder" class="fixed">
    <div class="inner">
      <div class="breadcrumb"> <a href="index.html">Home</a> » <a href="category.html">Pizza</a> » Pizza Delicioso </div>
      <h2 class="heading-title"><span>{{$product_info->product_name}}</span></h2>
      
      <!-- PRODUCT INFO -->
      <div class="product-info fixed">
        <div class="left">
          <div class="image"> <a href="image/bigimage00.jpg" class="cloud-zoom" id="zoom1" rel="adjustX: 5, adjustY:0, zoomWidth:550, zoomHeight:400, showTitle: false"> <img src="{{asset($product_info->product_image)}}" alt='{{$product_info->product_name}}' title="Pizza Delicioso" /></a> <span class="pricetag">BDT {{$product_info->product_new_price}}</span> </div>
          <div class="image-additional">
            <div class="image_car_holder">
              <ul class="jcarousel-skin-opencart">
                
                  <li><a href='image/bigimage00.jpg' class='cloud-zoom-gallery' title='Thumbnail 1' rel="useZoom: 'zoom1', smallImage: 'image/smallimage.jpg' "> <img src="image/tiny1.jpg" alt = "Thumbnail 1"/> </a></li>
                
              </ul>
            </div>
            <script type="text/javascript"><!--
      $('.image-additional ul').jcarousel({
	  vertical: false,
	  visible: 4,
	  scroll: 1
      });
      //--></script> 
          </div>
        </div>
        <div class="right">
          <div class="description"> 
             <span>Brand:</span> <a href="#">{{$product_info->manufacturer_name}}</a><br/>
            <span>Product Code:</span> Product 15<br/>
            <span>Availability:</span> In Stock 
            
          {!! Form::open(['url'=>'/add-to-cart', 'method'=>'POST']) !!}
          <div class="cart"> <span class="label">Qty:</span>
            <input type="text" value="1" size="2" name="qty" id="qty"/>
            <input type="hidden" value="{{$product_info->product_id}}" name="id" id="qty"/>
            <button class="button" id="button-cart" type="submit"><span>Add to Cart</span></button> <a href="#" class="wish_button" title="Add to Wish List">Add to Wish List</a> <a href="#" class="compare_button" title="Add to Compare">Add to Compare</a> 
          </div>
          {!! Form::close() !!}
          <div class="tags"> <span class="label">Tags:</span> <a href="#">Pizza</a> <a href="#">Italian</a> <a href="#">Food</a> <a href="#">Delivery</a> <a href="#">Vegetarian</a> <a href="#">Sample tag</a> </div>
        </div>
        <div class="clear"></div>
      </div>
      <!-- END OF PRODUCT INFO -->
      
      <div id="content">
        <div class="box">
          <h2 class="heading-title"><span>Description</span></h2>
          <div class="box-content">
            <p>{{$product_info->product_long_description}}</p>
          </div>
        </div>
        @php
        $category_id=$product_info->category_id;
        $product_id=$product_info->product_id;
        $product_info_by_category_id=DB::table('tbl_product')
                                                        ->where('category_id',$category_id)
                                                        ->where('publication_status',1)
                                                        ->get();
      @endphp
        <div class="cat_list">
          <h2 class="heading-title"><span>Related Products</span></h2>
          @foreach($product_info_by_category_id as $v_product)
          @if($v_product->product_id != $product_id)
          <div class="prod_hold"> <a class="wrap_link" href="product.html">
            <span class="image"><img src="{{asset($v_product->product_image)}}" alt="{{$v_product->product_name}}" /></span>
            </a>
            <div class="pricetag_small"> <span class="old_price">BDT {{$v_product->product_old_price}}</span> <span class="new_price">BDT {{$v_product->product_new_price}}</span> </div>
            <div class="info">
              <h3>{{$v_product->product_name}}</h3>
              <p>{{$v_product->product_short_description}}</p>
              <button class="add_to_cart_small" type="submit">Add to cart</button>> <a class="wishlist_small" href="#">Wishlist</a> <a class="compare_small" href="#">Compare</a> </div>
          </div>
          @endif
        @endforeach
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- END OF CONTENT -->
  @endsection