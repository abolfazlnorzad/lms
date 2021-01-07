<?php


namespace Nrz\Media\Services;


use Nrz\Media\Models\Media;

class MediaFileService
{

    private static $file;
    private static $dir;
    private static $isPrivate;

    public static function privateUpload($file){
        self::$file = $file;
        self::$dir = "app\private\\";
        self::$isPrivate = true;
        return self::upload();
    }

    public static function publicUpload($file)
    {
        self::$file = $file;
        self::$dir = 'app\public\\';
        self::$isPrivate = false;
        return self::upload();
    }

    private static function upload()
    {

        $extension = self::getExtensions(self::$file);
        foreach (config('mediaFile.mediaType') as $type => $service) {
            if (in_array($extension, $service['extensions'])) {
                return self::uploadByHandler(new $service['handler'], $type);
            }
        }
    }

    public static function delete($media)
    {
        foreach (config('mediaFile.mediaType') as $type => $service){
                if ($media->type==$type){
                    return $service['handler']::delete($media);
                }
        }
//        switch ($media->type) {
//            case 'image':
//                ImageFileService::delete($media);
//                break;
//        }
    }


    public static function getExtensions($file): string
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private static function filenameGenerator(){
        return uniqid();
    }
    private static function uploadByHandler( $service, $key)
    {
        return Media::create([
            'user_id' => auth()->id(),
            'files' => $service::upload(self::$file,self::filenameGenerator(),self::$dir),
            'type' => $key,
            'filename' => self::$file->getClientOriginalName(),
            'is_private' => self::$isPrivate
        ]);

    }
}
