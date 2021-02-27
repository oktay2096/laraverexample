<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekiModel extends Model
{
    protected $table ="ceki";
    protected $fillable = [
        'musteri' ,
        'aciklama' ,
        'sev_durum'
        
        
    ];

   
}
