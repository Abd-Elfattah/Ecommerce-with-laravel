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
		<form class="form-inline navbar-search" method="post" action="products.html" >
		<input id="srchFld" class="srchTxt" type="text" style="padding-left:30px" />
		  <select class="srchTxt">
			<option>All</option>
			<option>CLOTHES </option>
			<option>FOOD AND BEVERAGES </option>
			<option>HEALTH & BEAUTY </option>
			<option>SPORTS & LEISURE </option>
			<option>BOOKS & ENTERTAINMENTS </option>
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-left" style="margin-left:120px;margin-bottom:0px">
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
	<div  id="footerSection" style="margin-top: 230px">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.html">YOUR ACCOUNT</a>
				<a href="login.html">PERSONAL INFORMATION</a> 
				<a href="login.html">ADDRESSES</a> 
				<a href="login.html">DISCOUNT</a>  
				<a href="login.html">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>  
				<a href="register.html">REGISTRATION</a>  
				<a href="legal_notice.html">LEGAL NOTICE</a>  
				<a href="tac.html">TERMS AND CONDITIONS</a> 
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>  
				<a href="special_offer.html">SPECIAL OFFERS</a>  
				<a href="#">MANUFACTURERS</a> 
				<a href="#">SUPPLIERS</a> 
			 </div>
			<!-- <div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="{{ asset('themes/images/facebook.png')}}" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="{{ asset('themes/images/twitter.png')}}" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="{{ asset('themes/images/youtube.png')}}" title="youtube" alt="youtube"/></a>
			 </div>  -->
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


    @yield('scripts')

	<!-- Scripts -->

	

</div>
<span id="themesBtn"></span>
</body>
</html>