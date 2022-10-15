<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RotateImageController extends Controller
{
    public function index()
    {
        return view('components.image.rotate-image');
    }

    public function download(Request $request)
    {
        $images = $request->all()['images'];
        if (count($images) === 1) {
            $imageFileName = $images[0]['file']->getClientOriginalName();
            $expression = explode('.', $imageFileName)[1];
            $imagick = new \Imagick($images[0]['file']->getRealPath());
            $imagick->rotateImage('white', $images[0]['angel']);

            return response()->streamDownload(function () use($imagick) {
                echo $imagick->getImageBlob();
            }, $imageFileName, [
                'Content-type' => 'image/'.$expression,
                'filename' => $imageFileName
            ]);
        }

        $zip = new \ZipArchive();
        $fileNameZip = Str::uuid().'.zip';
        $pathToZip = public_path('upload/'.$fileNameZip);
        if ($zip->open($pathToZip, \ZipArchive::CREATE)) {
            foreach ($images as $image) {
                $imageFileName = $image['file']->getClientOriginalName();

                $imagick = new \Imagick($image['file']->getRealPath());
                $imagick->rotateImage('white', $image['angel']);

                $zip->addFromString($imageFileName, $imagick->getImageBlob());
            }
        }
        $zip->close();

        $zipContent = file_get_contents($pathToZip);

        return response()->streamDownload(function () use ($zipContent, $pathToZip) {
            echo $zipContent;
            unlink($pathToZip);
        }, $fileNameZip, [
            'Content-type' => 'application/zip',
            'filename' => $fileNameZip
        ]);

    }
}
