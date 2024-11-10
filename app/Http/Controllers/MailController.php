<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

   public function sendMail(){
    dd('send mail');
       try{

        $toEmailaddress = "mokaddes.ru2000@gmail.com";
        $welcomeMessage = "Welcome to our website";
        Mail::send('emails.welcome', ['welcomeMessage' => $welcomeMessage], function($message) use ($toEmailaddress){
            $message->to($toEmailaddress, 'Mokaddes')->subject('Welcome to our website');
        });

       }
         catch(Exception $e){
              \Log::error('Unable to send' . $e->getMessage());
         }
   }

}
