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
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'slug' => (string) $this->slug,
            'user_id' => (int) $this->user_id,
            'category_id' => (int) $this->category_id,
            'brand_id' => (int) $this->brand_id,
            'supplier_id' => (int) $this->supplier_id,
            'current_stock' => (int) $this->current_stock,
            'barcode' => (int) $this->barcode,
            'featured' => (bool) $this->featured,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'price' => (double) $this->price,
            'price_additional' => (string) $this->price_additional,
            'discount' => (double) $this->discount,
            'discount_type' => (string) $this->discount_type,
            'tax' => (double) $this->tax,
            'tax_type' => (string) $this->tax_type,
            'image' => asset($this->image),
            'gallery' => $this->gallery,
            'tags' => (string) $this->tags,
            'attributes' => (string) $this->attributes,
            'status' => (bool)$this->status,
            'child' => [
                'user' => new UserResource($this->user),
                'category' => new CategoryResource($this->category),
                'brand' => new BrandResource($this->brand),
                'supplier' => new SupplierResource($this->supplier)
            ]
        ];
    }

}
