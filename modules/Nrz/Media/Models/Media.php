<?php

namespace Nrz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\Media\Services\MediaFileService;

class Media extends Model
{
    use HasFactory;
    protected $appends=['thumb'];

    protected $fillable = [
        'user_id',
        'files',
        'type',
        'filename',
        'is_private',
    ];

    protected $casts = [
        'files' => 'json'
    ];


    protected static function booted()
    {
        self::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }
    public function getThumbAttribute()
    {
      return  MediaFileService::thumb($this);

    }

}
