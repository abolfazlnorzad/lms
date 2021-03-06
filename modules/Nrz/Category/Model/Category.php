<?php

namespace Nrz\Category\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'parent_id'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getParentAttribute()
    {
        return ($this->parent_id) ? $this->parentCategory->title :'ندارد';
    }

    public function path()
    {
        return route('categories.show', $this->id);
    }

}
