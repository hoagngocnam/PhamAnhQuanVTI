<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
    function sendMail(){
        Mail::to('anhquan.dev@gmail.com')->send(new SendMail);
    }
}
