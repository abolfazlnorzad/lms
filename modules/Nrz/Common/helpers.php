<?php

use Morilog\Jalali\Jalalian;

function newFeedback($title, $body, $type)
{
    $session = session()->get('feedback');
    $session[] = ["title" => $title, "body" => $body, "type" => $type];
    session()->flash('feedback', $session);
}


function createDateFromJalali($date, $format = "Y/m/d")
{
    return $date ? Jalalian::fromFormat($format, $date)->toCarbon() : null;
}


