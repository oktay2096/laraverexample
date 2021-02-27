<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekiUrunModel extends Model
{

    protected $table ="ceki_urun";
    protected $fillable = [
        'ceki_id',
        'barkod',
        'kumas_tipi',
        'metre',
        'parti_no',
        'lot',
        'aciklama',
        'kumas_id',
        'kalite',
        'en',
        'kg'
        
    ];
}
