<!DOCTYPE html>
<html>

<head>
  @include('Home.css')
  <style type="text/css">
  .div_deg
            {
              display: flex;
              justify-content: center;
              align-items: center;
              margin: 30px;

            }
            .table_deg
            {
              border: 2px solid greenyellow;
              width: 500px;
               

            }
            th
            {
              color: white;
              background: black;
              font-size: 19px;
              font-weight: bold;
              padding: 15px;
              text-align: center;

            }
            td
            {
              border: 1px solid green;
              text-align: center;
            }
            .value_deg
            {
              text-align: center;
              margin-bottom: 70px;
              padding:18px;
            }
            .order_deg
            {
              padding-right: 50px;
             

            }
            label
            {
              display: inline-block;
              width: 100px;
            }
            .div_gap
            {
              padding: 5px;
            }
            textarea
            {
              width: 300px;
              height: 100px;
              text-align: justify;
            }

 </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('Home.header')
    <!-- end header section -->
    
  </div>
  <!-- end hero area -->

            <div class="div_deg">
              
              <table class="table_deg">
                <tr>
                  <th>Product Title</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Remove</th>
                </tr>
                <?php
                  $value=0;
                ?>
                @foreach($cart as $cart)
                <tr>
                  <td>{{$cart->product->title}}</td>
                  <td>{{$cart->product->price}}</td>
                  <td>{{$cart->product->description}}</td>
                  <td><img height="120" width="120" src="products/{{$cart->product->image}}"></td>
                  <td><a class="btn btn-danger" href="{{url('delete_product_mycart',$cart->id)}}" >Remove</a></td>
                </tr>
                 <?php
                  $value=$value + $cart->product->price;
                ?>
                @endforeach
              </table>
               </div>
               
             <div class="value_deg">

              <h3>Total Value is : ${{$value}}</h3>

              </div>
           
             <div class="order_deg" style="display:flex; justify-content: center; align-items: center; margin-top: 2px;">
                <form action="{{url('confirm_order')}}" method="post">
                  @csrf
                  <div class="div_gap">
                  <label>Name</label>
                  <input type="text" name="name" value="{{Auth::user()->name}}">
                  </div>
                   <div class="div_gap">
                  <label>Address</label>
                  <textarea name="address">{{Auth::user()->address}}</textarea>
                  </div>
                  <div class="div_gap">
                  <label>Phone</label>
                  <input type="text" name="phone" value="{{Auth::user()->phone}}">
                  </div>
                  <div class="div_gap">
                    <input type="submit" class="btn btn-primary" value="Cash On Delivery">
                    <a class="btn btn-success" href="{{url('stripe',$value)}}" >Pay Using Card</a>
                  </div>
                </form>
              </div>




 
   

  <!-- info section -->

 @include('Home.footer')
</body>

</html>