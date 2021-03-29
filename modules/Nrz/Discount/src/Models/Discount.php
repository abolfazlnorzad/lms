<?php

namespace Nrz\Discount\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\Course\Model\Course;

class Discount extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts =[
        "expire_at" => "datetime"
    ];

    public function courses()
    {
        return $this->morphedByMany(Course::class, "discountable");
    }
}
