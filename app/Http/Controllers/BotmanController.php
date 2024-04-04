<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class BotmanController extends Controller
{
    public function handle(){
        $botman = app('botman');

        $botman->hears('{message}', function ($bot, $message) {
            switch($message)
            {
                case 'hi': $bot->reply('Hello! How may I assist you today?');
                break;

                case 'sino bb q': $bot->reply('si je em jeko maganda lov lov hihi');
                break;

                default: 
                    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');

            }
        });

        $botman->hears('tingin', function (BotMan $bot) {
            // Create attachment
            $attachment = new Image('https://scontent.fmnl8-2.fna.fbcdn.net/v/t1.15752-9/418973697_744247751008928_6169128377889210304_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFWdKiVLgVP_fpeWC3yvpdRSnZHj7agjLNKdkePtqCMs_YUpY69mJqW2fjfRhBdwrBbLyMuMMuGrC25eB-Ytt63&_nc_ohc=xNa0_tQ5iCMAX-TnKZ4&_nc_ht=scontent.fmnl8-2.fna&oh=03_AdSxBml4h98D7tHUBHLud0OmplABtiLNK81AK70BI3a3rA&oe=6631CABE');
        
            // Build message object
            $message = OutgoingMessage::create('ito oh hehe')
                        ->withAttachment($attachment);
        
            // Reply message object
            $bot->reply($message);
        });

        // $botman->hears('{message}', function ($bot, $message) {
        //     if($message == 'hi'){
        //         $bot->reply('Hello! How can I assist you today?');
                
        //     }
        //     else{
        //         $bot->reply("Sorry, I don't know the answer to that.");

        //     }
        // });

        $botman->listen();
    }
}
