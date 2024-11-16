<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">

        @foreach($product as $products)
        <div class="col-sm-8 col-md-4 col-lg-3">
          <div class="box">
            
              <div class="img-box">
                <img src="products/{{$products->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$products->title}}</h6>
                <h6>
                  Price
                  <span>{{$products->price}}</span>
                </h6>
              </div> 
                <div style="padding: 5px;margin: 15px; display: inline-block; justify-content: center; align-items: center;" >
                <a style="padding: 5px;" class="btn btn-danger " href="{{url('product_detailes',encrypt($products->id))}}">Detailes</a>
                
                <a style="padding: 5px;" class="btn btn-primary" href="{{url('add_cart',$products->id)}}">Add To Cart</a>
                </div>
              
           
          </div>
        </div>
        @endforeach


        
    </div>
  </div>
</section>
  
