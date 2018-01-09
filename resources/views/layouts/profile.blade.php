<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootshop online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link rel="stylesheet" href="{{ asset('themes/bootshop/bootstrap.min.css') }}" media="screen"/>
    
    <link href="{{ asset('themes/css/base.css') }}" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="{{ asset('themes/css/bootstrap-responsive.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('themes/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Google-code-prettify -->	
	<link href="{{ asset('themes/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>
<!-- fav and touch icons -->



	
	


	<link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('themes/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('themes/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href=" {{asset('themes/images/ico/apple-touch-icon-72-precomposed.png')}} ">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('themes/images/ico/apple-touch-icon-57-precomposed.png') }}">



    

	<style type="text/css" id="enject"></style>

	<link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>

	<style type="text/css">
		.navbar .nav > li > a{
			padding : 10px 7px;
		}

		
		.navbar .nav>li>a:focus, 
		.navbar .nav>li>a:hover
		{
			color:#FFF;
		}
		.showResult{
		
		    position: absolute;
		    /*display: inline-block;*/
		    right: 71px;
    		width: 269px;
		    margin-top: -7px;
		    z-index: 1;
		    background-color: #fff;
		    border-radius: 2px;
			
		}
		.showResult li{
			display: block;
			background-color:#FFFFFF;
			color: #2BBCDE;
			padding-left: 17px; 
			padding-bottom: 5px; 
			padding-top: 5px; 
			list-style: none;
			cursor: pointer;	
			border: 1px solid #ddd;	
			margin: 2px;		
			border-radius: 5px;
			font-weight: bold;
		}

		.showResult li:hover{
			background-color: #e0e0d1;
		}

		.searchPhoto{
			width:40px;
			height: 45px;
			margin-right: 13px;
		}
		.see-all{
				background:none;
			  	border:none;
			  	font-size:1em;
		}
	</style>

    @yield('styles')


	<!-- End-Styles -->


  </head>
<body>
<div id="header">
<div class="container">
<!-- <div id="welcomeLine" class="row">
	<div class="span6">Welcome!<strong> User</strong></div>
	<div class="span6">
	<div class="pull-right">
		
		
		<a href="product_summary.html"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 3 ] Itemes in your cart </span> </a> 
	</div>
	</div>
</div> -->
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="{!! url('Eco-home') !!}"><img src="{{asset('themes/images/logo.png')}}" alt="Bootsshop"/></a>
		

		<!-- Search -->
		<div>
		{!! Form::open(['method'=>'GET' , 'action'=>'FrontController@search' , 'class'=>'form-inline navbar-search' , 'style'=>'margin-left:100px']) !!}
		{!! csrf_field() !!}
			<input class="search" name="search" class="srchTxt" placeholder="Search ... " type="text" style="padding-left:10px;width: 250px" />
			<ul class="showResult">
				
			</ul>
		  
		  	<button type="submit" id="submitButton" class="btn btn-primary">Search</button>
		{!! Form::close() !!}
		</div>
		 <!-- {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!} -->
	<!-- Search -->


    <ul id="topMenu" class="nav pull-left" style="margin-left:190px;margin-bottom:0px">
	 <!-- <li class=""><a href="{{url('/Eco-home/special-offers')}}">Special Offers</a></li> -->
	 <!-- <li class=""><a href="normal.html">Delivery</a></li> -->
	 <!-- <li class=""><a href="contact.html">Contact</a></li> -->
@if(Auth::check())
	 <li class="">
	 <a href="{{route('cart.show')}}"><span class="btn btn-primary" ><i class="icon-shopping-cart icon-white" style="font-size:19px; text-shadow: 1px 1px 1px #ccc;"></i>
	 [ <span class="new-cart-update">{{ Session::has('cart') ? count(Session::get('cart')->items) : "0"}}</span> ]
	 </span></a>
	 </li>
@else
	<li class="">
	 <a href="{{ route('login')}}"><span class="btn btn-primary" ><i class="icon-shopping-cart icon-white" style="font-size:19px; text-shadow: 1px 1px 1px #ccc;"></i>
	 [ <span class="new-cart-update">0</span> ]
	 </span></a>
	 </li>
@endif

	@if(!Auth::check())
		 <li>
		 <a href="{{ route('login') }}"  style=""><span class="btn btn-success">Sign-in</span></a>
		 </li>
		 <li>
		 <a href="{{ route('register') }}"  style=""><span class="btn btn-default">Register</span></a>
		 </li>
	@endif

	  <!-- role="button" data-toggle="modal" -->
	<!--  <a href="product_summary.html"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 3 ] Itemes in your cart </span> </a>  -->

	 </ul>

	 @if(Auth::check())

	 	<ul class="nav navbar-top-links navbar-right" style="float:left;margin-top: 18px ">
	 		
	 		<li class="dropdown">
                    <a class="user-profile" data-toggle="dropdown" href="#" style="line-height: 0px;color:#fff;">
                        {{Auth::user()->firstname}} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ route('user.address' , Auth::user()->id) }}" style="line-height: 40px"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <li class="divider"></li>
                        <li>
                        	<a href="{{ route('logout') }}" style="line-height: 40px"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
            </li>

	 	</ul>
	 @endif	
	
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->




<div id="mainBody">
	<div class="container" style="margin-top:20px;">

	


	<div class="row">
	




		@if(Auth::check() && Auth::user()->status==0)
			<div class="span6 alert alert-block alert-error fade in" style="width:68%">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Your Email Not Activated,</strong> Activate Your Account to start Shopping .
			</div>
		@endif


		@if(Session::has('email_activate'))
			<div class="span6 alert alert-block alert-success fade in" style="width:68%">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{Session::get('email_activate')}},</strong> Start Shopping Now .
			</div>
		@endif




		@yield('content')




		
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<div  id="footerSection" style="margin-top: 200px">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				@if(Auth::check())
					<a href="{{route('user.address',Auth::user()->id)}}">ADDRESSES</a> 
					<a href="{{route('user.orders',Auth::user()->id)}}">ORDER HISTORY</a>
				@else
					<a href="{{route('login')}}">ADDRESSES</a> 
					<a href="{{route('login')}}">ORDER HISTORY</a>
				@endif
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<!-- <a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>   -->
				<a href="{{ route('offers') }}">SPECIAL OFFERS</a>  
			 </div>
		 </div>
		<p class="pull-right">&copy; Mahmoud Abd-Elfattah</p>
	</div><!-- Container End -->
	</div>
	






	<!-- Scripts -->

	<script src="{{ asset('themes/js/jquery.js') }}" type="text/javascript"></script> 
	<script src="{{ asset('themes/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('themes/js/google-code-prettify/prettify.js') }}"></script>
	<script src="{{ asset('themes/js/bootshop.js') }}"></script>
    <script src="{{ asset('themes/js/jquery.lightbox-0.5.js') }}"></script>

    <script type="text/javascript">
    	
    	$(document).ready(function(){
    		$('.search').keyup(function(){
    				

    			if( $('.search').val() != '' ){
    				var search_word = $(this).val();
    				var url = "{{ route('autoComplete') }}";
    				var li_lists = "";

    				$.ajax({
    					url:url,
    					method:"GET",
    					data:{search_word:search_word},
    					success:function(data){
    						// console.log(data[1]);
    						if(data[0] == 'success'){
    							data = data[1];
	    						for(var i=0; i <= 3 ;i++){
	    							li_lists+='<a style="text-decoration:none" href="'+data[i]['link']+'"><li><img class="searchPhoto" src="'+data[i]['path']+'"><span>'+data[i]['name']+'</span></li></a>';
	    							$('.showResult').html(" ").append(li_lists);
	    						}

	    						if(data.length > 3){
	    							see_all='<li><input class="see-all" type="submit" value="See All Results"></li>';
	    							$('.showResult').append(see_all);
	    						}

    						}else{
    							li_lists+='<li>No Search Results</li>';
    							$('.showResult').html(" ").append(li_lists);
    						}
    						
    					}
    				});


    			}else{
    				$('.showResult').empty();
    			}
    		});
    	});
 		
	</script>


    @yield('scripts')

	<!-- Scripts -->

	

</div>
<span id="themesBtn"></span>
</body>
</html>