@extends('master')
@section('main_content')
<div class="box">
          <h2 class="heading-title"><span>Manufacturer Products</span></h2>
          <div class="box-content">
            <div class="box-product fixed">
                
                @foreach($category_products as $v_product)
                <div class="prod_hold"> <a class="wrap_link" href="{{URL::to('/product-details/'.$v_product->product_name)}}"> <span class="image"><img width="150" height="150" src="{{asset($v_product->product_image)}}" alt="Spicylicious store" /></span> </a>
                <div class="pricetag_small"> <span class="old_price">BDT {{$v_product->product_old_price}}</span> <span class="new_price">BDT {{$v_product->product_new_price}}</span> </div>
                <div class="info">
                  <h3>{{$v_product->product_name}}</h3>
                  <p>{{$v_product->product_short_description}}</p>
                  <a class="add_to_cart_small" href="#">Add to cart</a> <a class="wishlist_small" href="#">Wishlist</a> <a class="compare_small" href="#">Compare</a> </div>
              </div>
                @endforeach
            </div>
            <div class="clear"></div>
          </div>
</div>
@endsection