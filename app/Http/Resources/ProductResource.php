<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>(string) $this->id,
            'category_id'=>(string) $this->category_id,
            'category_name'=> $this->category->name,
            'name'=>$this->name,
            'image'=>asset("images/".$this->image),
            'quantity'=>(string) $this->qty,
            'price'=>(string) $this->price,
            'created_at'=>$this->created_at
        ];
    }
}
