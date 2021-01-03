<?php


namespace Nrz\Common\Response;


class AjaxResponse
{
    public static function success()
    {
        return response(['message' => 'عملیات با موفقیت انجام شد'], 200);
    }

    public static function error()
    {
        return response(['message' => 'عملیات با موفقیت انجام نشد'], 500);

    }
}
