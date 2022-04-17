<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeship extends Model
{
    public $timestamp = false;
    protected $fillable = [
        'fee_matp', 'fee_maqh', 'fee_xaid', 'fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_fee_ship';

    public function city(){
        return $this->belongsTo('App\Models\thanhpho', 'fee_matp');
    }
    public function province(){
        return $this->belongsTo('App\Models\quanhuyen', 'fee_maqh');
    }
    public function wards(){
        return $this->belongsTo('App\Models\xathitran', 'fee_xaid');
    }
}
