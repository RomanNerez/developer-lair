<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Services\Image\ImageConstructorService;
use App\Utils\Image\DTO\ImageParametersDTO;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * @var ImageConstructorService
     */
    private $imageConstructorService;

    /**
     * @param ImageConstructorService $imageConstructorService
     */
    public function __construct(ImageConstructorService $imageConstructorService)
    {
        $this->imageConstructorService = $imageConstructorService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('components.image');
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
}