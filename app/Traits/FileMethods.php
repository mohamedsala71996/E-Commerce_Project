<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileMethods
{
   

    public function deleteFile($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }


}
