<?php

namespace App\Http\Controllers\Api;

use App\Image;
use App\Http\Controllers\Controller;
use App\Actions\Images\Store;
use App\Actions\Images\Edit;
use App\Actions\Images\Update;
use App\Actions\Images\Destroy;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageSimpleResource;
use App\Http\Resources\ImageFullResource;
use Illuminate\Http\Request;

/**
 * Class ImagesController
 *
 * @package App\Http\Controllers\Api
 */
class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $data = Image::orderBy("created_at", "desc")->paginate(12);
        return ImageSimpleResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageStoreRequest $request
     * @return ImageFullResource
     */
    public function store(ImageStoreRequest $request)
    {
        return (new Store)->handle($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return ImageFullResource
     */
    public function show(Image $image)
    {
        return new ImageFullResource($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @return ImageFullResource
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        return (new Update)->handle($request, $image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Image $image)
    {
        return (new Destroy)->handle($image);
    }
}
