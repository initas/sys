<!DOCTYPE html>
<HTML lang="en">
	<HEAD>
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
		@script('public/extension/autocomplete/jquery.autocomplete.js')
		@script('public/extension/done-typing/done-typing.js')
		@script('public/js/securhat/v1b0/lp/script.js')
		
		<!-- Raw Scripts -->
		@section('raw-script')
		@show
		
		<!-- Custom Scripts -->
		@section('scripts')
		@show
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		
		<?php
			define('V_URL', 'securhat/v1b0/lp');
		?>
		
	</HEAD>
	<BODY class="BODY">
		@include('securhat/v1b0/lp/layouts/header.php')
		@section('header')
		@show
		@section('content')
		@show
		@section('footer')
		@show
		@include('securhat/v1b0/lp/layouts/footer.php')
	</BODY>
</HTML>