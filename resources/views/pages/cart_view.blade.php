@extends('master')
@section('main_content')



<div id="content">
    <script>

    function remove_product_from_cart(id){
        
      var xhttp = new XMLHttpRequest();
      var server = "{{URL::to('/remove-product-from-cart')}}";
      server+='/'+id;
      xhttp.open("GET", server);
      xhttp.onreadystatechange = function() {
//        alert(this.status);
        if (this.readyState == 4 && this.status == 200) {
         document.getElementById("content").innerHTML = this.responseText;
        }
      };
      xhttp.send();
    }
    function ajax_update(id){
      var objid = 'qty'+id;
      var qty = document.getElementById(objid).value;
      var xhttp = new XMLHttpRequest();
      var server = "{{URL::to('/update-qty')}}";
      server+='/'+qty+'-'+id;
      xhttp.open("GET", server);
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         document.getElementById("content").innerHTML = this.responseText;
        }
      };
      xhttp.send();
    }

    </script>
    
    <div class="cart-info">
          <table>
            <thead>
              <tr>
                  <td class="remove">Remove</td>
                <td class="image">Image</td>
                <td class="name">Product Name</td>
                
                <td class="quantity">Quantity</td>
                <td class="price">Unit Price</td>
                <td class="total">Total</td>
              </tr>
            </thead>
            <tbody id="my_product">
              @php
              $cart_content=Cart::content();
              @endphp
              @foreach($cart_content as $v_content)
                <tr>
                    <td><button onclick="remove_product_from_cart('{{$v_content->id}}')">Remove</button></td>
                    <td class="image"><a href="product.html"><img width="100" height="100" src="{{$v_content->options['image']}}" alt="Spicylicious store" /></a></td>
                <td class="name"><a href="{{URL::to('/product-details/'.$v_content->name)}}">{{$v_content->name}}</a>
                  <div> </div></td>
                
                <td>
                    <input id="qty{{$v_content->id}}" type="text" size="3" value="{{$v_content->qty}}" name=""/>
                    <input type="button" value="Update" onclick="ajax_update('{{$v_content->id}}');" />
                </td>
                <td class="price">{{$v_content->price}}</td>
                <td class="total">{{$v_content->price * $v_content->qty}}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
        
        <div class="cart-total">
          <table>
            <tbody>
              <tr>
                <td colspan="5"></td>
                <td class="right"><b>Sub-Total:</b></td>
                <td class="right numbers">@php $total = Cart::total(2,'.',''); echo 'BDT '.$total; @endphp</td>
              </tr>
              <tr>
                <td colspan="5"></td>
                <td class="right"><b>VAT 15%:</b></td>
                <td class="right numbers">@php $vat = ($total*15)/100; echo 'BDT '.$vat @endphp</td>
              </tr>
              <tr>
                <td colspan="5"></td>
                <td class="right numbers_total"><b>Total:</b></td>
                <td class="right numbers_total">@php $grand_total = $total+$vat; echo 'BDT  '.$grand_total; @endphp</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="buttons">
          <div class="left"><a class="button" onclick="#"><span>Update</span></a></div>
          <div class="right"><a class="button" href="#"><span>Checkout</span></a></div>
          <div class="center"><a class="button" href="#"><span>Continue Shopping</span></a></div>
        </div>
    </div>



@endsection