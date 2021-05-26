<?php

Route::resource("tickets","TicketController");
Route::post("tickets/reply/{ticket}","TicketController@reply")->name("tickets.reply");
Route::get("tickets/close/{ticket}","TicketController@close")->name("tickets.close");
