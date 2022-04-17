<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thanhpho extends Model
{
    protected $fillable = [
        'name_tp', 'type'
    ];
    protected $primaryKey = 'matp';
    protected $table = 'tbl_tinhthanhpho';
}
