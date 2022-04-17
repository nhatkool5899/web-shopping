<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $timestamp = false;
    protected $fillable = [
        'category_id', 'brand_id', 'product_name', 'product_quantity', 'product_sold', 'product_desc', 'product_content', 'product_price', 'product_img', 'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}
