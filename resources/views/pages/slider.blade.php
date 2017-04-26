@extends('master')
@section('slider_content')
<div class="box featured-box">
          <h2 class="heading-title"><span>Featured Products</span></h2>
          <div class="box-content">
            <ul id="myRoundabout">
              @php
                $all_featured_product = DB::table('tbl_product')
                                    ->where('is_featured',1)
                                    ->get();
              @endphp
              @foreach($all_featured_product as $v_product)
              <li>
                <div class="prod_holder"> <a href="{{URL::to('/product-details/'.$v_product->product_name)}}"> <img src="{{asset($v_product->product_image)}}" alt="{{$v_product->product_name}}" /> </a>
                  <h3>{{$v_product->product_name}}</h3>
                </div>
                <span class="pricetag">BDT {{$v_product->product_new_price}}</span>
              </li>
              @endforeach
            </ul>
            <a href="#" class="previous_round">Previous</a> <a href="#" class="next_round">Next</a> </div>
        </div>
@endsection

