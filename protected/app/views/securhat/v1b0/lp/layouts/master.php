<?php
	define('V_URL', 'securhat/v1b0/lp');
?>
		
<!DOCTYPE html>
<HTML lang="en">
	<HEAD>
		<meta charset="utf-8">
		<title>Securhat</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<link rel="shortcut icon" href="{{URL::to('img/stock/'.V_URL.'/favicon.ico')}}" type="image/x-icon">
		
		<!-- Styles -->
		@style('public/extension/bootstrap/css/bootstrap.css')
		@style('public/extension/font-awesome/css/font-awesome.min.css')
		@style('public/css/securhat/v1b0/lp/default.css')
		@style('public/css/securhat/v1b0/auto-complete.css')
		
		<!-- Raw Styles -->
		@section('raw-style')
		@show
		
		<!-- Custom Scripts -->
		@section('style')
		@show
		
		<!-- Scripts -->
		@script('public/extension/bootstrap/js/jquery-1.11.2.min.js')
		@script('public/extension/bootstrap/js/bootstrap.min.js')
		@script('https://maps.googleapis.com/maps/api/js?v=3.exp')
		@script('public/extension/autocomplete/jquery.autocomplete.js')
		@script('public/extension/done-typing/done-typing.js')
		@script('public/js/securhat/v1b0/lp/script.js')
		
		<!-- Raw Scripts -->
		@section('raw-script')
		@show
		
		<!-- Custom Scripts -->
		@section('scripts')
		@show
		
	</HEAD>
	<BODY class="BODY">
		@include('securhat/v1b0/lp/layouts/header.php')
		@section('header')
		@show
		@section('content')
		@show
		@section('footer')
		@show
		@section('modals')
		@show
		@include('securhat/v1b0/lp/layouts/footer.php')
	</BODY>
</HTML>