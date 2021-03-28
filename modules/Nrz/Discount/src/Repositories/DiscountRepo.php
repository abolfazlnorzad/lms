<?php

namespace Nrz\Discount\Repositories;

use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use Nrz\Discount\Models\Discount;

class DiscountRepo
{
    public $discount;

    public function __construct()
    {
        $this->discount = Discount::query();
    }

    public function getAllDiscount()
    {
        return $this->discount->latest()->paginate(25);
    }

    public function store($data)
    {
        $discount = $this->discount->create([
            "user_id" => auth()->id(),
            "code" => $data['code'],
            "percent" => $data['percent'],
            "usage_limitation" => $data['usage_limitation'],
            "expire_at" => $data["expire_at"] ? Jalalian::fromFormat('Y/m/d H:i', $data["expire_at"])->toCarbon() : null,
            "link" => $data['link'],
            "description" => $data['description'],
            "type" => $data['type']
        ]);

        if ($discount->type == "special") {
            $discount->courses()->sync($data['courses']);
        }

    }

    public function update($discount, $data)
    {
        $discount->update([
            "code" => $data['code'],
            "percent" => $data['percent'],
            "usage_limitation" => $data['usage_limitation'],
            "expire_at" => $data["expire_at"] ? Jalalian::fromFormat('Y/m/d H:i', $data["expire_at"])->toCarbon() : null,
            "link" => $data['link'],
            "description" => $data['description'],
            "type" => $data['type']
        ]);
        if ($discount->type === "special") {
            $discount->courses()->sync($data['courses']);
        } else {
            $discount->courses()->sync([]);
        }
    }

}
