<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    public $timestamp = false;
    protected $fillable = [
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_message'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
}
