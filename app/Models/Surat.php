<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table='surat';
    protected $guarded=[];

    public static function uploadFile($ext)
    {
        return  'Surat_'.date('Y-m-d_H-i-s').".".$ext;
    }
}
