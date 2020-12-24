<?php


namespace Nrz\User\Services;


class verifyCodeService
{

    public static $prefix = 'verify_code_';

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

        cache()->set(self::$prefix . $id, $code, now()->addHour());


    }

    public static function get($id)
    {
        return cache()->get(self::$prefix . $id);
    }

    public static function has($id)
    {
        return cache()->has(self::$prefix . $id);
    }

    public static function delete($id)
    {
        cache()->delete(self::$prefix . $id);
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
