<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Mail\SendWelcomeMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
   public function sendMail()
   {
       try {
           $toEmailAddress = "mokaddes.ru2000@gmail.com";
           $welcomeMessage = "Welcome to our website";


           Mail::to($toEmailAddress)->send(new SendWelcomeMail($welcomeMessage));


           dd('Mail sent successfully!');
       } catch (Exception $e) {
           \Log::error('Unable to send email: ' . $e->getMessage());
       }
   }
}

