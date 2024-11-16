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

            }
            th
            {
              color: white;
              background: skyblue;
              font-size: 19px;
              font-weight: bold;
              padding: 15px;
            }
            td
            {
              border: 1px solid green;
              text-align: center;
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
                  <th>Description</th>
                  <th>Catagory</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Delivery Status</th>
                </tr>
                
                @foreach($order as $products)
                <tr>
                  <td>{{$products->product->title}}</td>
                  <td>{!!Str::words($products->product->description,3)!!}</td>
                  <td>{{$products->product->catagory}}</td>
                  <td>{{$products->product->price}}</td>
                  
                  <td><img height="120" width="120" src="products/{{$products->product->image}}"></td>
                  <td>{{$products->status}}</td>
                  </tr>
                  @endforeach
                </table>
              </div>
   

  <!-- info section -->

 @include('Home.footer')
</body>

</html>