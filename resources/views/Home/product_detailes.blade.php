<!DOCTYPE html>
<html>

<head>
  @include('Home.css')
  <style type="text/css">
  	
  	.img-box
  	{
  		display: flex;
  		justify-content: center;
  		align-items: center;
  		padding: 30px;
  	}
  	.detail-box
    {
    	padding: 15px;
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

  <!-- product detailes -->
   <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">

       
        <div class="col-md-10">
          <div class="box">
            
              <div class="img-box">
                <img width="300px" height="300px" src="/products/{{$product->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$product->title}}</h6>
                <h6>
                  Price:
                  <span>{{$product->price}}</span>
                </h6>
              </div> 
                
              <div class="detail-box">
                <h6>Catagory:{{$product->catagory}}</h6>
                <h6>
                  Available Quantity:
                  <span>{{$product->quantity}}</span>
                </h6>
              </div> 
                
              <div class="detail-box">
                  
                  <p>{{$product->description}}</p>
                
              </div> 
          </div>
        </div>
        


        
    </div>
  </div>
</section>
  
  <!-- end product detailes -->







 

   

  <!-- info section -->

 @include('Home.footer')
</body>

</html>