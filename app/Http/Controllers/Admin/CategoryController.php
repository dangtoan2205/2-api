<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Exception;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories =  $this->categoryService->getAll($paginate = true);
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
    /**
     *  Get all category no paginate
     */
    public function getCategory()
    {
        try {
            $categories =  $this->categoryService->getAll($paginate = false);
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $result =  $this->categoryService->store($request->all());
            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category =  $this->categoryService->find($id);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryService->update($id, $request->all());
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = $this->categoryService->delete($id);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
}
