<?php

namespace App\Http\Controllers\Admin;

use App\Services\ProductService;
use App\Services\TagService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    protected $productService;

    protected $tagService;

    protected $categoryService;

    public function __construct(
        ProductService $productService,
        TagService $tagService,
        CategoryService $categoryService
    ) {
        $this->productService = $productService;
        $this->tagService = $tagService;
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
            $products =  $this->productService->getAll($paginate = true);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
    /**
     *  Get product by slug
     */
    public function getProductBySlug($slug)
    {
        try {
            $products =  $this->productService->getProductBySlug($slug);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
    /**
     *  Get all product no paginate
     */
    public function getProduct()
    {
        try {
            $products =  $this->productService->getAll($paginate = false);
            return response()->json($products, 200);
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
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->all();
            if (isset($data['image_url'])) {
                $image  = $this->productService->saveImage($data['image_url']);
                $data['image_url'] = $image;
            }
            $data['slug'] = Str::slug($data['name']);
            $product = $this->productService->store($data);
            $product->tags()->attach($data['tags']);
            return response()->json($product, 200);
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
            $product =  $this->productService->find($id);
            $product->image_url = URL::to('images/' . $product->image_url);
            $product->tags;
            return response()->json([
                'product' => $product,
            ], 200);
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
    public function update(ProductRequest $request, $id)
    {
        try {
            $data = $request->all();
            $product =  $this->productService->find($id);
            if (isset($data['image_url'])) {
                $image  = $this->productService->saveImage($data['image_url']);
                $data['image_url'] = $image;
            }
            $data['slug'] = Str::slug($data['name']);
            $result = $this->productService->update($id, $data);
            $product->tags()->sync($data['tags']);
            return response()->json($result, 200);
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
        $product =  $this->productService->find($id);
        if ($product->image_url) {
            $path = public_path($product->image_url);
            File::delete($path);
        }
        try {
            $product = $this->productService->delete($id);
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
}
