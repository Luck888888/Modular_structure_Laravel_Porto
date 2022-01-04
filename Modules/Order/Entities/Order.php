<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'currency',
        'amount'
    ];

    public function goods()
    {
        return $this->hasMany(OrderItem::class, 'order_id','id');
    }

    public function getAmountAttribute(){
        return $this->goods()->where('order_id', $this->id)
            ->sum('total_amount');
    }

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\OrderFactory::new();
    }
}
