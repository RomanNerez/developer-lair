<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadMediaController extends Controller
{
    public function uploadImage(Request $request)
    {
        $image = $request->file('image');

        $filename = date('Y-m-d-H-i-s').'_'.Str::uuid().'.'.$image->extension();

        $result = Storage::disk('upload')->putFileAs('', $image,  $filename);

        return response()->json([
            'url' => url('/upload/'.$result)
        ]);
    }
}
