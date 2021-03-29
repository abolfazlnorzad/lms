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


    public function getValidDiscountQuery($type = "all", $id = null)
    {
        $query = Discount::query()
            ->where(function ($query) {
                $query->where("expire_at", ">", now())
                    ->orWhereNull("expire_at");
            })
            ->whereNull("code")
            ->where("type", $type);
        if ($id) {
            $query->whereHas("courses", function ($query) use ($id) {
                $query->where("id", $id);
            });
        }

        $query->where(function ($query) {
            $query->where("usage_limitation", ">", "0")
                ->orWhereNull("usage_limitation");
        })
            ->orderBy("percent", "desc");

        return $query;
    }

    public function getGlobalBiggerDiscount()
    {
        return $this->getValidDiscountQuery()
            ->first();
    }

    public function getCourseBiggerDiscount($id)
    {
        return $this->getValidDiscountQuery('special', $id)->first();
    }

    public function checkCodeDiscountIsValid($discountCode, $courseId)
    {
        return Discount::query()
            ->where("code", $discountCode)
            ->where(function ($query) {
                $query->where("usage_limitation", ">", "0")
                    ->orWhereNull("usage_limitation");
            })
            ->where(function ($query) {
                $query->where("expire_at", ">", now())
                    ->orWhereNull("expire_at");
            })
            ->where(function ($query) use ($courseId) {
                return $query->whereHas("courses", function ($query) use ($courseId) {
                    return $query->where("id", $courseId);
                })->orWhereDoesntHave("courses");
            })
            ->first();
    }

}

