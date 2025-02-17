<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'total_amount'];

    /**
     * Get the order items associated with the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * (Optional) Get the user that placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
