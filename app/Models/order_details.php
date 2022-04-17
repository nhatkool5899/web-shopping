<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    public $timestamp = false;
    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'product_image', 'product_desc', 'product_price', 'product_order_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    public function wards(){
        return $this->belongsTo('App\Models\product', 'product_id');
    }
}
