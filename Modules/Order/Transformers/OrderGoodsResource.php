<?php

namespace Modules\Order\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderGoodsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'order_id'     => $this->order_id,
            'name'         => $this->name,
            'quantity'     => $this->quantity,
            'total_amount' => $this->total_amount,
        ];
    }
}
