<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\Share;
use App\Services\Image\ImageService;
use App\Services\ZipArchiveService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CropImageController extends Controller
{
    private $imageService;

    private $zipArchiveService;

    public function __construct(ImageService $imageService, ZipArchiveService $zipArchiveService)
    {
        $this->imageService = $imageService;
        $this->zipArchiveService = $zipArchiveService;
    }

    public function index()
    {
        return view('components.image.crop-image');
    }

    public function cropping(Request $request)
    {
        $images = $request->all()['images'];

        $dataForZip = [];

        foreach ($images as $image) {
            $dataForZip[] = [
                'fileName' => $image['file']->getClientOriginalName(),
                'resource' => $this->imageService->crop(
                    $image['file']->getRealPath(),
                    $image['width'],
                    $image['height'],
                    $image['x'],
                    $image['y'],
                )
            ];
        }

        $path = $this->zipArchiveService->createZip($dataForZip);

        $uuid = Str::uuid();

        Share::create([
            'uuid' => $uuid,
            'type' => 'image',
            'file_name' => $path
        ]);

        return response()->json([
            'uuid' => $uuid
        ]);
    }
}
