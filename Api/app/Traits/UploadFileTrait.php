<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFileTrait
{
    public function upload($driver, $file, $path): array
    {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $path = $path . "/" . $extension;
            return  [$extension => Storage::disk($driver)->putFileAs($path, $file, $filename)];
    }

}
