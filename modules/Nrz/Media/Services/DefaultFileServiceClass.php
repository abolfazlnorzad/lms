<?php


namespace Nrz\Media\Services;


use Illuminate\Support\Facades\Storage;
use Nrz\Media\Models\Media;

abstract class DefaultFileServiceClass
{
    public static $media;

    abstract static function getFilename();


    public static function delete($media)
    {
        foreach ($media->files as $file) {

            if ($media->is_private) {
                Storage::delete('/private/' . $file);
            } else {
                Storage::delete('/public/' . $file);
            }

        }
    }


    public static function stream(Media $media)
    {

        static::$media = $media;
        $stream = Storage::readStream(static::getFilename());

        return response()->stream(function () use ($stream) {
            while (ob_get_level() > 0) ob_get_flush();
            fpassthru($stream);
        }, 200,
            [
                "Content-Type" => Storage::mimeType(static::getFilename()),
                "Content-disposition" => "attachment; filename='" . static::$media->filename . "'"
            ]
        );
    }
}