@extends('securhat/v1b0/lp/layouts/master.php')

@section('scripts')
	@script('public/bootstrap/js/bootstrap.min.js')
@stop

@section('content')
	@if('ok')
		ok
	@else
		jika
	@endif
@stop

@section('modal')
	@include('securhat/v1b0/lp/modals/modal-1.php')
	@include('securhat/v1b0/lp/modals/modal-2.php')
@stop