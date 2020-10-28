<?php declare(strict_types=1);

namespace AsyncBot\Plugin\ShouldI\ValueObject\Result;

class Is
{
    private string $reply;

    public function __construct(string $reply)
    {
        $this->reply = $reply;
    }


    public function getReply(): string
    {
        return $this->reply;
    }
}
