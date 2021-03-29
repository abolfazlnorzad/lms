<?php

namespace Nrz\Discount\Services;

class DiscountService
{

    public static function getAmountDiscount($price, $percent)
    {
        return $price * ((float)("0." . $percent));
    }

}
