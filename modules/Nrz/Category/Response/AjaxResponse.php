<?php


namespace Nrz\Category\Response;


class AjaxResponse
{
    public static function success()
    {
        return response(['message' => 'عملیات با موفقیت انجام شد'], 200);
    }
}
