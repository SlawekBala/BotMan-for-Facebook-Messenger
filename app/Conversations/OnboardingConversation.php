<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;


class OnboardingConversation extends Conversation
{
    protected $number;

    protected $email;

    public function age()
    {

        $this->ask('Ile masz lat?', function(Answer $answer) {

            $this->number = $answer->getText();

            if ($this->number >= 13 && $this->number <= 100) {
                $question = Question::create('Dziękuje. Twój rok urodzenia to ' .$this->number = 2019 - $this->number)
                    ->fallback('Unable to ask question')
                    ->callbackId('askFirstname')
                    ->addButtons([
                        Button::create('Tak')->value('yes'),
                        Button::create('Nie')->value('no'),
                    ]);

                 $this->ask($question, function (Answer $answer) {
                    if ($answer->isInteractiveMessageReply()) {
                        if ($answer->getValue() === 'yes') {
                            $this->say('Świetnie. Dziękuje za odpowiedź.');

                        } else
                            $this->age();

                    }
                });

            }

            else
                $this->say('Proszę o podanie wieku w zakresie 13 do 100 lat')->age();

        });
    }


    public function run()
    {
        // This will be called immediately
        $this->age();
    }
}