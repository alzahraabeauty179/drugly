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
        return 
            is_null($this->store)? 
            [
                'name'          => $this->name
            ]
            : 
            [
                'id'            => $this->id,
                'name'          => $this->name,
                'storeId'       => $this->store->id,
                'storeName'     => $this->store->name,
                'amount'        => $this->amount,
                'unitPrice'     => $this->unit_price,
                'unit'          => $this->unit,
                'type'          => $this->type
            ];
    }
}
