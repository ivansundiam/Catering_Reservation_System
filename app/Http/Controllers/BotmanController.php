<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Web\WebDriver;

class BotmanController extends Controller
{
    public function handle(){
        $botman = app('botman');

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

                default: 
                    $question = Question::create('Sorry, I did not understand these commands. Here is a list of commands I understand:');
                    $question->addButtons([
                        Button::create('"Hi" or "Hello"')->value('hi'),
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
