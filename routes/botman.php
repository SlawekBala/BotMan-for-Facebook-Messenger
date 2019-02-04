<?php
use App\Http\Controllers\BotManController;
use App\Conversations\OnboardingConversation;

$botman = resolve('botman');

$botman->hears('', function($bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $bot->reply('Cześć! ' . $firstname);

    $bot->startConversation(new OnboardingConversation);
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');


$botman->fallback(function($bot) {
    $bot->reply('Przepraszam, nie wiem o czym piszesz');
});



