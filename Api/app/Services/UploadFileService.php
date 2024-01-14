<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public function upload($driver, $file, $path): array
    {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            return  [$extension => Storage::disk($driver)->putFileAs($path, $file, $filename)];
    }

}
