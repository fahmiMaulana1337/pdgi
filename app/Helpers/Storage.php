<?php

namespace App\Helpers;


use App\Models\Surat;

class Storage
{
    public static function uploadSurat($fileSurat)
    {
        $ext = $fileSurat->getClientOriginalExtension();
        $name = Surat::uploadFile($ext);
        $fileSurat->move(base_path("public/assets/surat"), $name);
        return $name;
    }
}

?>