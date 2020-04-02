<?php

namespace App\Domain\Services;

use App\Domain\SessionInterface;

class Chat
{
    private $messages = [
        "If my calculator had a history, it would be more embarrassing than my browser history.",
        "The Olympics should have a 'For Fun' section at the end of all the games so all the athletes can try different sports.",
        "Aliens invaded the Moon on July 20th, 1969.",
        "I've woken up over 10,000 times and I'm still not used to it.",
        "Christmas feels more like a deadline than a holiday.",
        "\"DO NOT TOUCH\" would probably be a really unsettling thing to read in braille.",
        "Gyms should have memberships where your fee goes down based on how often you go.",
        "Nothing is on fire, fire is on things.",
        "Every time a character dies on a TV show I just feel bad for the actor who pretty much just got fired in front of us.",
        "It's sad that having real ingredients in food products is a selling point.",
        "If cats had wings, they'd still just lay there.",
    ];

    /**
     * @var \App\Domain\SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getChat()
    {
        $chat = $this->session->get('chat');
        if (!$chat) {
            $chat = [];
        }
        $chat[] = new ChatMessage($this->getRandomMessage());
        $this->session->set('chat', $chat);

        return $chat;
    }

    public function getRandomMessage()
    {
        return $this->messages[array_rand($this->messages)];
    }

    public function addMessage($message, $sentBy)
    {
        $chat = $this->session->get('chat');
        $chat[] = new ChatMessage($message, $sentBy);
        $this->session->set('chat', $chat);
    }
}
