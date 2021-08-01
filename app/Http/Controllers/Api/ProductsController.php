<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(20));
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['qty'] = $request->quantity;
        $data['image'] = rand(1,20).'.jpg';
        $data['category_id'] = Category::all()->random(1)->first()->id;
        $product = Product::create($data);

        return response()->json(['data'=>$product,'message'=>'Product Added Successfully'],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $prod = Product::where('id',$product)->first();
        if(!$prod){
            return response()->json(['data'=>'','message'=>"this product not found"],404);
        }
        return new ProductResource($prod);
    }



    
}
