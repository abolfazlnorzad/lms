<?php

use Morilog\Jalali\Jalalian;

if (!function_exists('newFeedback')) {
    function newFeedback($title, $body, $type)
    {
        $session = session()->has('feedback') ? session()->get('feedback') : [];
        $session[] = ["title" => $title, "body" => $body, "type" => $type];
        session()->flash('feedback', $session);
    }
}
//function newFeedback($title = 'عملیات موفقیت آمیز', $body = 'عملیات با موفقیت انجام شد', $type = 'success'){
//    $session = session()->has('feedbacks') ? session()->get('feedbacks') : [];
//    $session[] = ['title' => $title, "body"=>  $body, "type" => $type];
//    session()->flash('feedbacks', $session);
//}

if (!function_exists('createDateFromJalali')) {
function createDateFromJalali($date, $format = "Y/m/d")
{
    return $date ? Jalalian::fromFormat($format, $date)->toCarbon() : null;
}

}
