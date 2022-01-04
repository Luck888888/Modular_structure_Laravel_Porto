<?php

namespace Modules\Order\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'order_number' => $this->order_number,
            'currency'     => $this->currency,
            'amount'       => $this->amount,
            'goods'        => OrderGoodsResource::collection($this->goods),
        ];
    }
}
