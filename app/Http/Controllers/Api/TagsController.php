<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\Actions\Tags\Update;
use App\Actions\Tags\Store;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;

/**
 * Class TagsController
 *
 * @package App\Http\Controllers\Api
 */
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'all');
        $tabMap = [
            "most_used" => Tag::withCount("images")
                    ->orderBy("images_count", "desc")->take(20),
            "least_used" => Tag::withCount("images")
                    ->orderBy("images_count", "asc")->take(20),
            'first' => Tag::orderBy('created_at')->take(20),
            'last' => Tag::orderBy('created_at', 'desc')->take(20),
            'all' => Tag::orderBy('created_at', 'desc'),
        ];
        $data = $tabMap[$tab]->get();

        return TagResource::collection($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return TagResource
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagStoreRequest $request
     * @return TagResource
     */
    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->only("name"));
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagUpdateRequest $request
     * @param Tag $tag
     * @return TagResource
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $tag->update($request->only("name"));
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json();
    }
}
