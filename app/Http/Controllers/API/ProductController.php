<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequestCreate;
use App\Http\Requests\ProductRequestUpdate;
// use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Exception;
use App\Models\Product;

class ProductController extends Controller
{

    // private $productRepository;
    // protected $productService;

    public function __construct()
    {
        // $this->productRepository = new productRepository;
        $this->productService = new productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
        //     $asd +=2;
        // } catch (\Throwable $e) {
        //     // throw response(['message' => $e], 500);
        //     return response(['message' => $e->getMessage(),
        //                     'code' => $e->getCode()], 500);
        // }
        $products = $this->productService->getAll();
        // dd($products);
        // $product = Product::first();
        // return new ProductResource($product);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequestCreate $request)
    {
        $validated_data = $request->validated();
        $product = Product::create($validated_data);

        return new ProductResource($product);
        // dd($validated_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $product = Product::find($product);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequestUpdate $request, Product $product)
    {
        $validated_data = $request->validated();
        $product->update($validated_data);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(['message' => 'berhasil dihapus'], 200);
    }
}
