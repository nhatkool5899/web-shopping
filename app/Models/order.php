<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public $timestamp = false;
    protected $fillable = [
        'customer_id', 'shipping_id', 'payment_id', 'order_total', 'order_status', 'order_code', 'order_coupon', 'order_feeship'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
}
