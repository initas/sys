@extends('securhat/v1b0/layouts/master.php')

@section('header')
	ini header
@stop

@section('test')
	@foreach($response['results']['data'] as $id => $data)
		@if($id%2)
			<div>{{dd($data)}}</div>
		@endif
	@endforeach
@stop