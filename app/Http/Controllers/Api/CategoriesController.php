<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(){
        return CategoryResource::collection(Category::take(10)->get());
    }

    public function allCategories(){
        return CategoryResource::collection(Category::paginate(10));
    }

    public function getProducts($id){
        Category::findOrFail($id);
        return CategoryResource::collection(Category::where('id',$id)->get());
    }

    public function show($category){
        $cat = Category::where('id',$category)->first();
        if(!$cat){
            return response()->json(['data'=>'','message'=>"this category not found"],404);
        }
        return new CategoryResource($cat);
    }

}
