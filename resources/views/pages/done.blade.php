@extends('layout')

@section('content')
	<div class="jumbotron text-center">
		<h1>Bulk Image Processor</h1>
		<h2>Done Resizing {{ $count }} images!</h2>
		<h3>Saved in folder "{{ $date }}"</h3>
	</div>

	<div class="container text-center">
		<a class="btn btn-primary" href="/">Process More Images</a>
	</div>
@stop
