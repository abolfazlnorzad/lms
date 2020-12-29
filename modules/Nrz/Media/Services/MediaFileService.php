<?php


namespace Nrz\Media\Services;


use Nrz\Media\Models\Media;

class MediaFileService
{
    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        switch ($extension) {
            case 'png':
            case 'jpeg':
            case 'jpg':

                $media = Media::create([
                    'user_id' => auth()->id(),
                    'files' => ImageFileService::upload($file),
                    'type' => 'image',
                    'filename' => $file->getClientOriginalName(),
                    'is_private' => false
                ]);
                return $media;
                break;

            case 'mp4':
            case 'mvk':
            case 'avi':
                VideoFileService::upload($file);
                break;
        }
    }

    public static function delete($media)
    {
        switch ($media->type){
            case 'image':
                ImageFileService::delete($media);
                break;
        }
    }
}
