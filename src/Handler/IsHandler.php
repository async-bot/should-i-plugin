<?php declare(strict_types=1);

namespace AsyncBot\Plugin\ShouldI\Parser;

use AsyncBot\Plugin\ShouldI\ValueObject\Result\Is;

class IsHandler
{
    private const RESPONSES = [
        "yes" => [
            "Yes.",
            "I think so.",
            "God, yes!",
        ],
        "no" => [
            "No.",
            "[nooooooooooooooo](http://www.nooooooooooooooo.com/)!",
            "Let me think about it … wait … yes … well actually, no.",
        ],
        "dunno" => [
            "Dunno.",
            "No idea …",
            "What the hell are you talking about?",
            "Let me think about it … dunno …",
            "I think you know the answer already.",
        ],
    ];

    public function getResponse(): Is
    {
        $reply = random_int(0, 1) ? "yes" : "no";

        if (!random_int(0, 15)) {
            $reply = "dunno";
        }

        $reply = $this->getRandomReply($reply);

        return new Is($reply);
    }

    private function getRandomReply(string $answer): string
    {
        return self::RESPONSES[$answer][random_int(0, (count(self::RESPONSES[$answer]) - 1))];
    }

}
