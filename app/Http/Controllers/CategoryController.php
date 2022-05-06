<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateCategoryRequest, UpdateCategoryRequest};
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    public function __construct(protected Category $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = $this->repository->create($request->validated());
        return (new CategoryResource($category));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $category = $this->repository->where('url', $url)->firstOrFail();
        return (new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $url)
    {
        $category = $this->repository->where('url', $url)->firstOrFail();
        $category->update($request->validated());

        return response()->json(['message' => 'The category updated with success.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
