<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xathitran extends Model
{
    protected $fillable = [
        'name_xa', 'type', 'maqh'
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
