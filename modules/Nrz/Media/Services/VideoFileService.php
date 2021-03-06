<?php


namespace Nrz\Media\Services;


use Nrz\Media\Models\Media;

class VideoFileService  extends DefaultFileServiceClass
{

    public static function upload($file,$name,$dir)
    {

        $extension = $file->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        $file->move(storage_path($dir), $filename);
        return ["video" =>$filename];
    }
    public static function thumb(Media $media)
    {
        return url("/img/video-thumb.png");
    }

    public static function getFilename()
    {
        return (static::$media->is_private ? 'private/' : 'public/') . static::$media->files['video'];
    }
}
