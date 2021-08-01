<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($request->is('api/all-categories')){
            return [
                'id'=>(string) $this->id,
                'name'=>$this->name,
                'created_at'=>$this->created_at
            ]; 
        }

        return [
            'id'=>(string) $this->id,
            'name'=>$this->name,
            'products'=>ProductResource::collection(Product::where('category_id',$this->id)->take(6)->get()),
            'created_at'=>$this->created_at
        ];
        
        
    }
}
