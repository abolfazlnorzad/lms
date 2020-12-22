<?php


namespace Nrz\User\Services;


class verifyCodeService
{
    /**
     * @return int
     */
    public static function createCode()
    {
        $code = mt_rand(100000, 999999);
        return $code;
    }

    public static function store($id, $code)
    {

        cache()->set('verify_code_' . $id, $code, now()->addHour());


    }

    public static function get($id)
    {
        return cache()->get('verify_code_' . $id);
    }

    public static function delete($id)
    {
        cache()->delete('verify_code_' . $id);
    }

    public static function check($id, $code)
    {
        $status = self::get($id) == $code;
        if ($status) {
            self::delete($id);
            return true;
        }
        return false;
    }

}
