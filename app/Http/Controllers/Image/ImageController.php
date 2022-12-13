<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\Share;
use App\Services\Image\ImageConstructorService;
use App\Services\Image\ImageService;
use App\Services\ZipArchiveService;
use App\Utils\Image\DTO\ImageParametersDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * @var ImageConstructorService
     */
    private $imageConstructorService;

    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * @var ZipArchiveService
     */
    private $zipArchiveService;

    /**
     * @param ImageConstructorService $imageConstructorService
     */
    public function __construct(
        ImageConstructorService $imageConstructorService,
        ImageService $imageService,
        ZipArchiveService $zipArchiveService
    )
    {
        $this->imageConstructorService = $imageConstructorService;
        $this->imageService = $imageService;
        $this->zipArchiveService = $zipArchiveService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('components.image.index');
    }

    public function compress()
    {
        return view('components.image.compress-image');
    }

    public function resize()
    {
        return view('components.image.resize-image');
    }

    public function crop()
    {
        return view('components.image.crop-image');
    }

    public function builder()
    {
        $fonts = config('fonts');
        return view('components.image.image_builder', compact('fonts'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function generate(Request $request)
    {
        $imageDTO = new ImageParametersDTO();
        $imageDTO->setWidth($request->get('width', 0));
        $imageDTO->setHeight($request->get('height', 0));
        $imageDTO->setFabricData($request->get('fabric_data'));

        $generalImage = $this->imageConstructorService->build($imageDTO);

        return response()->streamDownload(function () use ($generalImage) {
            echo $generalImage;
        }, "test.png");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function preview(Request $request)
    {
        $imageDTO = new ImageParametersDTO();
        $imageDTO->setWidth($request->get('width', 0));
        $imageDTO->setHeight($request->get('height', 0));
        $imageDTO->setFabricData($request->get('fabric_data'));

        $generalImage = $this->imageConstructorService->build($imageDTO);

        return response()->make($generalImage, 200, [
            'Content-type' => 'image/png'
        ]);
    }

    public function download($fileName)
    {
        return view('components.image.download');
    }

    public function share(string $uuid)
    {
        $shareFile = Share::where('uuid', $uuid)->first();
        return view('components.image.share', compact('shareFile'));
    }

    public function resizing(Request $request)
    {
        $images = $request->all()['images'];

        $dataForZip = [];

        foreach ($images as $image) {
            $dataForZip[] = [
                'fileName' => $image['file']->getClientOriginalName(),
                'resource' => $this->imageService->resize(
                    $image['file']->getRealPath(),
                    $image['width'],
                    $image['height'],
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
