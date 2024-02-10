<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public function uploadFile($driver, $fileData, $path, $model, $attribute): ?array
    {
        $oldFile = isset($model) ? $model->{$attribute}["file"] : "";
        $oldFileKey = isset($model) ? $model->{$attribute}["key"] : null;

        //attach new file and detach old
        if (isset($fileData["file"]))
        {
            $this->deleteFile($driver, $oldFile);
            return $this->createFile($fileData, $path, $driver);
        }

        //not attach or detach file
        else if ($fileData["key"] == $oldFileKey)
        {
            return $model->{$attribute};

        }

        //detach file
        else {
            $this->deleteFile($driver, $oldFile);
            return null;
        }

    }

    public function getExtension($file): string
    {
        return $file->getClientOriginalExtension();
    }

    public function createFileName($key, $extension): string
    {
        return "$key.$extension";
    }

    public function createFileKey(): string
    {
        $digits = range(0, 5);
        shuffle($digits);
        return time(). implode("", $digits);
    }


    public function createFile($fileData, $path, $driver): array
    {
        $file = $fileData["file"] ?? null;
        $titleFile = $fileData["title"] ?? null;

        $key = $this->createFileKey();
        $extension = $this->getExtension($file);
        $filename = $this->createFileName($key, $extension);

        return [
            "key" => $key,
            "file" => Storage::disk($driver)->putFileAs($path, $file, $filename),
            "title" => $titleFile
        ];
    }

    public function deleteFile($driver, $path): void
    {
        if (Storage::disk($driver)->exists($path))
            Storage::disk($driver)->delete($path);
    }

}
