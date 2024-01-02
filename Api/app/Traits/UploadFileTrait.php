<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

trait UploadFileTrait
{
    public function upload($driver, $file, $path, $sizes): array|string
    {
        if (isset($sizes) && count($sizes) > 0)
        {


            return [];
        }

        else
        {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $path = $path . "/" . $extension;
            return  [$extension => Storage::disk($driver)->putFileAs($path, $file, $filename)];
        }
    }

}
