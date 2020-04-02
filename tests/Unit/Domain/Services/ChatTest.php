<?php

namespace Tests\Unit\Domain\Services;

use App\Domain\Services\Chat;
use App\Domain\Services\ChatMessage;
use App\Domain\SessionInterface;
use PHPUnit\Framework\TestCase;

class ChatTest extends TestCase
{
    /**
     * @var SessionInterface | \PHPUnit\Framework\MockObject\MockBuilder
     */
    private $sessionMock;

    /**
     * @var \App\Domain\Services\Chat
     */
    private $chat;

    public function setUp(): void
    {
        $this->sessionMock = $this->getMockBuilder(SessionInterface::class)->getMock();
        $this->chat = new Chat($this->sessionMock);
    }

    public function testGettingRandomMessage()
    {
        $message = [];
        for($i=0; $i<10; $i++) {
            $message[] = $this->chat->getRandomMessage();
        }

        $differentMessages = [];
        foreach ($message as $m) {
            if (!in_array($m, $differentMessages)) {
                $differentMessages[] = $m;
            }
        }

        $this->assertTrue(count($differentMessages) >= 2);
    }

    public function testCreatingChatWhenGettingNewChat()
    {
        $this->sessionMock->expects($this::once())->method('get')->with('chat')->willReturn(null);
        $this->sessionMock->expects($this::once())->method('set');
        $chat = $this->chat->getChat();

        $this->assertNotEmpty($chat);
    }

    public function testMessageAddedToExistingChatWhenGettingChat()
    {
        $chat = [new ChatMessage('message')];
        $this->sessionMock->expects($this::once())->method('get')->with('chat')->willReturn($chat);
        $this->sessionMock->expects($this::once())->method('set');
        $updatedChat = $this->chat->getChat();

        $this->assertEquals(count($chat)+1, count($updatedChat));
    }

    public function testAddingMessage()
    {
        $message = 'new message';
        $sentBy = 2;
        $chat = [new ChatMessage('original chat message')];
        $expectedChat = array_merge($chat, [new ChatMessage($message, $sentBy)]);
        $this->sessionMock->expects($this::once())->method('get')->with('chat')->willReturn($chat);
        $this->sessionMock->expects($this::once())->method('set')->with('chat', $expectedChat);

        $this->chat->addMessage($message, $sentBy);
    }
}
