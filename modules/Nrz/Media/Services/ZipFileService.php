<?php


namespace Nrz\Media\Services;


class ZipFileService
{
    use DefaultFileService;
    public static function upload($file,$name,$dir)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        $file->move(storage_path($dir), $filename);
        return ["zip" =>$filename];
    }

}
