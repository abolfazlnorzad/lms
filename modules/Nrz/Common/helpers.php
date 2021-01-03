<?php

function newFeedback($title, $body, $type)
{
    $session = session()->get('feedback');
    $session[] = ["title" => $title, "body" => $body, "type" => $type];
        session()->flash('feedback',$session);
}
