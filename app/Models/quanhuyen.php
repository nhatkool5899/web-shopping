<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quanhuyen extends Model
{
    protected $fillable = [
        'name_qh', 'type', 'matp'
    ];
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';
}
