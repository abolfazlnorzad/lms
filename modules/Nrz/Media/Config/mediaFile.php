<?php

return [
    "mediaType" => [
        "image" => [
            "extensions" => [
                "png", "jpg", "jpeg"
            ],
            "handler" => \Nrz\Media\Services\ImageFileService::class,

        ],
        "video"=>[
            "extensions" => [
                "mp4", "avi", "mkv"
            ],
            "handler" => \Nrz\Media\Services\VideoFileService::class,
        ],
        "zip"=>[
            "extensions" => [
                "zip", "rar", "tar"
            ],
            "handler" => \Nrz\Media\Services\ZipFileService::class,
        ]
    ],

];
