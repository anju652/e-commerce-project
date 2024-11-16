<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('/admincss/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('/admincss/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('/admincss/css/font.css')}}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->'
    <link rel="stylesheet" href="{{asset('/admincss/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('/admincss/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('/admincss/img/favicon.ico')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

        	<style type="text/css">


        		.div_deg
        		{
        			display: flex;
        			justify-content: center;
        			align-items: center;
        			margin: 30px;

        		}
        		label
        		{
        			display: inline-block;
        			width: 200px;
        			padding: 20px;
        		}
        		textarea
        		{
        			width: 400px;
        		}
        	</style>

  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Admin</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>

            <!-- Log out               -->
            <div class="list-inline-item logout">  

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <input type="submit" value="Logout" >
            </form>                
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Mark Stephen</h1>
            <p>Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
                <li><a href="{{url('view_catagory')}}"> <i class="icon-grid"></i>Catagory </a></li>
                
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i> Products</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_product')}}">Add Product</a></li>
                    <li><a href="{{url('view_product')}}">View Product</a></li>
                    
                  </ul>
                </li>
                
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          	 <h1>Update Product</h1>
             <div class="div_deg">
              <form action="{{url('update_product',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="input_deg">

              <label>Product Title</label>
              <input type="text" name="title" value="{{$data->title}}">
            </div>
            <div class="input_deg">
                <label>Description</label>
                <textarea name="description">{{$data->description}}</textarea>
              </div>
               <div class="input_deg">
                <label>Price</label>
                <input type="text" name="price" value="{{$data->price}}">
              </div>
              <div class="input_deg">
                <label>Quantity</label>
                <input type="number" name="qty" value="{{$data->quantity}}">
              </div>
              <div class="input_deg">
                <label>Product Catagory</label>
                <select name="catagory">
                  <option value="{{$data->catagory}}">{{$data->catagory}}</option>
                  @foreach($catagory as $catagory)
                  <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                  @endforeach
            
                </select>
              </div>
              <div class="input_deg">
                <label>Current Image</label>
                <img width="150" height="150" src="/Products/{{$data->image}}">
              </div>
               <div class="input_deg">
                <label>New Image</label>
                <input type="file" name="image">
               </div>
            <div>
              <input class="btn btn-secondary" type="submit" value="update Product">
            </div>
          </form>
             </div>
           </div>
        </div>
      </div>
      
    <!-- JavaScript files-->
    <script src="{{asset('/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
  </body>
</html>