<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFileTrait
{
    public function upload($driver, $file, $path): array
    {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            return  [$extension => Storage::disk($driver)->putFileAs($path, $file, $filename)];
    }

}
