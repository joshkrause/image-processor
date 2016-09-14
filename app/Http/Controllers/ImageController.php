<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Http\Requests;
use Illuminate\Http\Request;

class ImageController extends Controller
{

 	// Bulk image resizing
	public function getDimensions()
	{
		return view('pages.get_dimensions');
	}

	// Go back to get Dimensions page, but with the old content
	public function back(Request $request)
	{
		// pass on old sizes
		$heights = $request->heights;
		$widths = $request->widths;
		$ratios = $request->ratios;
		$names = $request->names;

		return view('pages.get_dimensions', compact('heights', 'widths', 'ratios', 'names'));
	}

	public function addPhotos(Request $request)
	{

		// remove old uploaded photos
		$dropzone_path = base_path() . '/public/dropzone';
		File::cleanDirectory($dropzone_path);

		// pass on sizes to next view
		$heights = $request->heights;
		$widths = $request->widths;
		$ratios = $request->ratios;
		$names = $request->names;

		return view('pages.add_photos', compact('heights', 'widths', 'ratios', 'names'));
	}

	/*
	* Dropzone uploads here
	*/
	public function uploadPhotos(dropzoneRequest $request)
	{
		$dropzone_path = base_path() . '/public/dropzone';

		$file = $request->file('file');
		$filename = str_replace(' ', '-', $file->getClientOriginalName());

		$img = Image::make($file);
		$img->save($dropzone_path . '/'. $filename);

		return 'photo uploaded!';
	}

	public function process(Request $request)
	{
		$heights = $request->heights;
		$widths = $request->widths;
		$ratios = $request->ratios;
		$names = $request->names;

		$date = date("Y-m-d-H-i-s");

		$path = base_path() . '/public/image-output/' . $date;
		if(!File::exists($path))
		{
			File::makeDirectory($path);
		}
		$files = File::allFiles(base_path().'/public/dropzone');

		for($i = 0; $i<count($widths);$i++)
		{
			if($widths[$i] != '' && $heights[$i] != '')
			{
				$count = 0;
				foreach($files as $file)
				{

					$name = $widths[$i] . 'x' . $heights[$i];
					if($names[$i] != '')
					{
						$name = $names[$i];
					}

					if(!File::exists($path . '/' . $name))
					{
						File::makeDirectory($path . '/' . $name);
					}
			    	$img = Image::make($file);

			    	if($ratios[$i] == 'resize')
			    	{
						$img->resize($widths[$i], $heights[$i], function ($constraint) {
			                $constraint->aspectRatio();
			                $constraint->upsize();
			            });
			    	}
			    	else
			    	{
				        $img->fit($widths[$i], $heights[$i]);
			    	}
			    	$count++;
			       	$img->save($path .'/'.$name.'/'. sprintf('%04d', $count) .'.png');
				}
			}
		}
		return view('pages.done' ,compact('count', 'date'));
	}

}
