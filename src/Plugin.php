<?php declare(strict_types=1);

namespace AsyncBot\Plugin\ShouldI;
use AsyncBot\Plugin\ShouldI\ValueObject\Result\ShouldI;
use AsyncBot\Plugin\ShouldI\ValueObject\Result\Is;


use Amp\Promise;
use AsyncBot\Plugin\ShouldI\Parser\IsHandler;
use AsyncBot\Plugin\ShouldI\Parser\ShouldIHandler;

final class Plugin
{
    /**
     * @return ShouldI
     */
    public function getShould(string $choice1, string $choice2): ShouldI
    {
        return (new ShouldIHandler())->should($choice1, $choice2);
    }
    /**
     * @return Is
     */
    public function getIs(): Is
    {
        return (new IsHandler())->getResponse();
    }
}
