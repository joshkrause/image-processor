
@extends('layout')

@section('content')

	<div class="jumbotron text-center">
		<h1>Bulk Image Processor</h1>
		<h2>Step 1: Choose Dimensions</h2>
	</div>

	<div class="container">

		<form class="form" method="POST" action="/add-photos">
		{{csrf_field()}}

			<div class="row form-group">
				<div class="col-sm-4">
					<label>Folder Name (optional)</label>
				</div>
				<div class="col-sm-2">
					<label>Width (px)</label>
				</div>
				<div class="col-sm-2">
					<label>Height (px)</label>
				</div>
				<div class="col-sm-2">
					<label>Aspect Ratio</label>
				</div>
			</div>

			@if(empty($widths))
			<div class="row form-group">
				<div class="col-sm-4">
					<input class="form-control" name="names[]" type="text">
				</div>
				<div class="col-sm-2">
					<input class="form-control" name="widths[]" type="number">
				</div>
				<div class="col-sm-2">
					<input class="form-control" name="heights[]" type="number">
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="ratios[]">
						<option value="crop">Crop</option>
						<option value="resize">Maintain Aspect Ratio</option>
					</select>
				</div>
				<div class="col-sm-2">
					<span class="btn btn-danger delete-row-button">Delete Row</span>
				</div>
			</div>
			@else

			@foreach($widths as $key=>$val)
			<div class="row form-group">
				<div class="col-sm-4">
					<input class="form-control" name="names[]" value="{{ $names[$key] }}" type="text">
				</div>
				<div class="col-sm-2">
					<input class="form-control" name="widths[]" value="{{ $widths[$key] }}" type="number">
				</div>
				<div class="col-sm-2">
					<input class="form-control" name="heights[]" value="{{ $heights[$key] }}" type="number">
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="ratios[]">
						<option value="crop" {{	$ratios[$key] == "crop" ? 'selected' : ''}} >Crop</option>
						<option value="resize" {{	$ratios[$key] == "resize" ? 'selected' : ''}} >Maintain Aspect Ratio</option>
					</select>
				</div>
				<div class="col-sm-2">
					<span class="btn btn-danger delete-row-button">Delete Row</span>
				</div>
			</div>
			@endforeach

			@endif



			<div id="new-row-area"></div>


			<hr>

			<div class="row form-group">
				<div class="col-sm-12">
					<a id="add-row-button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Another Size</a>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-sm-12">
					<button class="btn btn-success pull-right" type="submit">Next</button>
					<button class="btn" type="reset">Reset</button>
				</div>
			</div>

		</form>
	</div>

@stop

