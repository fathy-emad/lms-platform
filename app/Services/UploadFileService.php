<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public function uploadFile($driver, $fileData, $path, $model, $attribute): ?array
    {
        //attach new file and detach old
        if (isset($fileData["file"]))
        {
            $this->deleteFile($driver, $model->{$attribute}["file"] ?? "");
            return $this->createFile($fileData, $path, $driver);
        }

        //not attach or detach file
        else if (isset($fileData["key"]))
        {
            if (isset($fileData["title"]))
            {
                $image = $model->{$attribute};
                $image['title'] = $fileData["title"];
                $model->{$attribute} = $image;
            }
            return $model->{$attribute};
        }

        //detach file
        else {
            $this->deleteFile($driver, $model->{$attribute}["file"] ?? "");
            return null;
        }

    }


    public function uploadFiles($driver, $filesData, $path, $model, $attribute): ?array
    {
        $return = null;

        //handling old files
        if (isset($model->{$attribute})) {

            foreach ($model->{$attribute} as $oldFileData) {
                if (! in_array($oldFileData["key"], array_column($filesData ?? [], "key"))){

                    //delete from uploads
                    $this->deleteFile($driver, $oldFileData["file"]);

                } else {
                    $oldFileData["title"] = array_column($filesData, "title", "key")[$oldFileData["key"]];
                    $return[] = $oldFileData;
                }
            }

            $return = array_values($return);
        }


        //attach new files
        if (isset($filesData))
        {
            foreach ($filesData AS $file){
                if (isset($file["file"])) $return[] = $this->createFile($file, $path, $driver);
            }
            $return = array_values($return ?? []) ?: null;
        }

        return $return;
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
        $file = $fileData["file"];
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
