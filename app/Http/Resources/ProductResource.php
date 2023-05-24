<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'supplier_id' => $this->supplier_id,
            'current_stock' => $this->current_stock,
            'featured' => $this->featured,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'price' => $this->price,
            'price_additional' => $this->price_additional,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'tax' => $this->tax,
            'tax_type' => $this->tax_type,
            'image' => asset($this->image),
            'gallery' => $this->gallery,
            'tags' => $this->tags,
            'attributes' => $this->attributes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'child' => [
                'user' => new UserResource($this->user),
                'category' => new CategoryResource($this->category),
                'brand' => new BrandResource($this->brand),
                'supplier' => new SupplierResource($this->supplier)
            ]
        ];
    }
}