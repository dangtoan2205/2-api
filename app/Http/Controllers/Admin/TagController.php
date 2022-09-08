<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use App\Services\TagService;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tags =  $this->tagService->getAll($paginate = true);
            return response()->json($tags, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    /**
     *  Get all category no paginate
     */
    public function getTag()
    {
        try {
            $tags =  $this->tagService->getAll($paginate = false);
            return response()->json($tags, 200);
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
    public function store(TagRequest $request)
    {
        try {
            $result =  $this->tagService->store($request->all());
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
            $tag =  $this->tagService->find($id);
            return response()->json($tag, 200);
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
    public function update(TagRequest $request, $id)
    {
        try {
            $tag = $this->tagService->update($id, $request->all());
            return response()->json($tag, 200);
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
            $tag = $this->tagService->delete($id);
            return response()->json($tag, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
}
