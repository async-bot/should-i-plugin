<?php declare(strict_types=1);

namespace AsyncBot\Plugin\ShouldI\Parser;

use AsyncBot\Plugin\ShouldI\ValueObject\Result\Is;
use AsyncBot\Plugin\ShouldI\ValueObject\Result\ShouldI;

class ShouldIHandler
{
    public function should(string $choice1, string $choice2): ShouldI
    {
        $yes = $choice1;
        $no = strtolower($choice2) === 'not' ? 'not ' . $choice1 : $choice2;
        $answer = $this->translatePronouns(random_int(0, 1) ? $yes : $no);

        return new ShouldI($answer);
    }


    private function translatePronouns(string $text): string
    {
        static $replacePairs = [
            'iyou' => ['i', 'you'],
            'youi' => ['^you', 'i'],
            'myyour' => ['my', 'your'],
            'yourmy' => ['your', 'my'],
            'meyou' => ['me', 'you'],
            'youme' => ['you', 'me'],
            'myselfyourself' => ['myself', 'yourself'],
            'yourselfmyself' => ['yourself', 'myself'],
            'mineyours' => ['mine', 'yours'],
            'yoursmine' => ['yours', 'mine'],
        ];
        static $expr;

        if (!isset($expr)) {
            $parts = [];

            foreach ($replacePairs as $name => $pair) {
                $parts[] = "\\b(?P<$name>$pair[0])\\b";
            }

            $expr = '#' . implode('|', $parts) . '#i';
        }

        return preg_replace_callback($expr, function($match) use($replacePairs) {
            foreach ($match as $name => $text) {
                if ($text !== '' && isset($replacePairs[$name])) {
                    return $replacePairs[$name][1];
                }
            }

            return 'banana';
        }, $text);
    }

}
