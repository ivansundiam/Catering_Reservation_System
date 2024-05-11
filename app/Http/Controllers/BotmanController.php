<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Web\WebDriver;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Middleware\Wit;

class BotmanController extends Controller
{
    public function handle(){
        $botman = app('botman');
        // $wit = Wit::create('7OKQ5YKEHRHKQI7M24VFI46Z6223ERB7');

        // // Apply global "received" middleware
        // $botman->middleware->received($wit);

        // // Apply matching middleware per hears command
        // $botman->hears('Greeting', function (BotMan $bot) {
        //     // $bot->getResponse();
        //     $bot->reply("this is my reply");
        // })->middleware($wit);

        $botman->hears('{message}', function ($bot, $message) {
            $message = strtolower($message);
            switch($message)
            {
                case 'hi':
                case 'hello':
                    $bot->reply('Hello! How may I assist you today?');
                    break;

                case 'how to sign in?':
                case 'login':
                $bot->reply(' Click the Login link: <a href="' . route('login') . '" target="_parent">Login</a> then input your email and password.');
                break;
                
                case 'how to sign up?':
                case 'register':
                $bot->reply(' Click the Sign up link: <a href="' . route('register') . '" target="_parent">Sign up</a><br />- Fill out the forms until all fields are filled.<br />- Click Sign Up after you have filled out the forms<br />- Wait to receive an email to verify your account.<br />- After receiving the verification email, you can now make a reservation!');
                break;

                case 'can i see the menu?':
                case 'services':
                $bot->reply('Our menu is located in the "Services" section. <a href="/#services" target="_parent">Click this link</a> to see services.');
                break;

                case 'what is the payment method?':
                case 'payment':
                $bot->reply("Here's our Payment Method, which you can pay through GCASH or PAYMAYA: <br />
                <br />       
                20% DOWN (NON-REFUNDABLE)<br />
                30% ONE WEEK BEFORE THE OCCASION<br />
                40% ONE MONTH BEFORE THE OCCASION<br />
                10% ON THE EVENT DAY<br />
                <br />
                <br />
                <br />");
                break;

                case 'what are the requirements for reservation?':
                case 'reservation':
                $bot->reply("Requirements for Reservation:<br />
                    <br />Here are the requirements for making a reservation:
                    <br />1st: You need to sign up to create an account, and it must be verified.
                    <br />2nd: Fill out the information needed for the reservation.
                    <br />3rd: Select preferred date and time of the event.
                    <br />4th: Select menu preferences.
                    <br />5th: Add any optional items if needed.
                    <br />6th: Proceed to make the payment for your reservation then take a screenshot of the Gcash or Maya payment receipt.
                    <br />7th: Attach the image receipt in the dropbox to verify your reservation.
                    <br />
                    <br />After completing all the steps, you have now successfully set a reservation!
                    ");
                break;

                case 'where are you located?':
                case 'location':
                $bot->reply("Robert Camba's catering services is located in Unit 107 Westeria Residences 77 west ave, Quezon City, Philippines");
                break;

                case 'what time are the operating hours?':
                case 'time':
                $bot->reply('Our reservation hours are from <u>8:00 AM to 8:00 PM</u>. Feel free to reserve during this time.');
                break;

                default: 
                    $question = Question::create('Sorry, I did not understand these commands. Here is a list of commands I understand:');
                    $question->addButtons([
                        Button::create('"Hi" or "Hello"')->value('hi'),
                        Button::create('Can I see the menu?')->value('services'),
                        Button::create('How to sign in?')->value('login'),
                        Button::create('How to sign up?')->value('register'),
                        Button::create('Where are you located?')->value('location'),
                        Button::create('What is the payment method?')->value('payment'),
                        Button::create('What are the requirements for reservation?')->value('reservation'),
                        Button::create('What time are the operating hours?')->value('time'),
                        Button::create('What are the services')->value('services'),
                    ]);
                    $bot->reply($question);
                    break;

            }
        });
        
        $botman->fallback(function($bot) {
            $bot->reply("Sorry, I don't know the answer to that.");
        });

        $botman->listen();
    }
}
