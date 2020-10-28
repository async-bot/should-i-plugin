<?php declare(strict_types=1);

namespace AsyncBot\Plugin\ShouldI\ValueObject\Result;

class ShouldI
{
    private string $choice;

    public function __construct(string $choice)
    {
        $this->choice = $choice;
    }


    public function getChoice(): string
    {
        return $this->choice;
    }
}
