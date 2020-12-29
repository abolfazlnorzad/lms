<?php


namespace Nrz\Media\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService
{
    public static $sizes = ['300', '600'];

    public static function upload($file)
    {
        $name = uniqid();
        $extension = $file->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        $dir = 'app\public\\';
        $file->move(storage_path($dir), $filename);
        $path = $dir . $filename;
        return self::resize(storage_path($path), $dir, $name, $extension);


    }

    protected static function resize($img, $dir, $name, $extension)
    {
        $img = Image::make($img);
        $imags['original'] = $name . '.' . $extension;
        foreach (self::$sizes as $size) {
            $imags[$size] = $name . $size . '.' . $extension;
            $img->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(storage_path($dir) . $name . $size . '.' . $extension);
        }

        return $imags;

    }

    public static function delete($media)
    {
        foreach ($media->files as $file) {
            Storage::delete('/public/' . $file);
        }
    }

}