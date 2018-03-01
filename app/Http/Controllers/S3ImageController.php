<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class S3ImageController extends Controller
{
    public function imageUpload()
    {
    	return view('image-upload');
    }

    public function imageUploadPost(Request $request)
    {
    	$name = time() . '.' . $request->image->getClientOriginalExtension();
    	$image = $request->image;
    	$t = Storage::disk('s3')->put($name, file_get_contents($image), 'public');
    	$name = Storage::disk('s3')->url($name);

    	return back()->with('success','Image Uploaded successfully.')
    		->with('path',$name);
    }
}
