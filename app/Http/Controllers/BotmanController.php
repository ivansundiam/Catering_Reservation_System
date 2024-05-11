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

                case 'reserve':
                    $bot->reply('Sure! Here are some commands you can try:');
                    break;

                case 'can i see the menu?':
                case 'services':
                $bot->reply('Our menu is located in the "Services" section. <a href="/#services" target="_parent">Click this link</a> to see services.');
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
                        Button::create('Where are you located?')->value('location'),
                        Button::create('What time are the operating hours?')->value('time'),
                        Button::create('How to make a reservation')->value('reserve'),
                        Button::create('How to sign in')->value('register'),
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
