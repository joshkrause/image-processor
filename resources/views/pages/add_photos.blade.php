@extends('layout')

@section('content')

	<div class="jumbotron text-center">
		<h1>Bulk Image Processor</h1>
		<h2>Step 2: Upload Photos</h2>
	</div>


	<div class="container">

		<div class="row">
			<table class="table">
				<thead>
					<th>Name</th>
					<th>Width</th>
					<th>Height</th>
					<th>Aspect Ratio</th>
				</thead>
				<tbody>
					@foreach($widths as $key=>$val)
					@if( $widths[$key] != '' && $heights[$key] != '' && $widths[$key] > 0 && $heights[$key] )
					<tr>
						<td> {{ $names[$key] == '' ? $widths[$key].'x'.$heights[$key] : $names[$key] }}</td>
						<td> {{ $widths[$key] }} </td>
						<td> {{ $heights[$key] }}</td>
						<td> {{ $ratios[$key] }} </td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>

		<form class="form dropzone" method="POST" action="/upload-photos">
		{{csrf_field()}}
		</form>

		<?php $count = 0 ?>

		<form class="form" method="POST" action="/process">
		{{csrf_field()}}
			@foreach($widths as $key=>$val)

				@if( $widths[$key] != '' && $heights[$key] != '' && $widths[$key] > 0 && $heights[$key] )
				<?php $count++ ?>
				@endif

				<input type="hidden" name="names[]" value="{{$names[$key]}}">
				<input type="hidden" name="widths[]" value="{{$widths[$key]}}">
				<input type="hidden" name="heights[]" value="{{$heights[$key]}}">
				<input type="hidden" name="ratios[]" value="{{$ratios[$key]}}">
			@endforeach

			<button {{ $count < 1 ? 'disabled' : '' }} class="btn btn-success pull-right" type="submit">Process</button>
		</form>


		<form class="form" method="POST" action="/back">
		{{csrf_field()}}
			@foreach($widths as $key=>$val)
				<input type="hidden" name="names[]" value="{{$names[$key]}}">
				<input type="hidden" name="widths[]" value="{{$widths[$key]}}">
				<input type="hidden" name="heights[]" value="{{$heights[$key]}}">
				<input type="hidden" name="ratios[]" value="{{$ratios[$key]}}">
			@endforeach

			<button class="btn" type="submit">Back</button>
		</form>

	</div>


@stop