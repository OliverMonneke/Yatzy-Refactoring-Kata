<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Yatzy;

class YatzyTest extends TestCase
{
    public function test_chance_scores_sum_of_all_dice(): void
    {
        $expected = 15;
        $actual = (new Yatzy(2, 3, 4, 5, 1))->chance();
        self::assertSame($expected, $actual);
        self::assertSame(16, (new Yatzy(3, 3, 4, 5, 1))->chance());
    }

    public function test_yatzy_scores_50(): void
    {
        $expected = 50;
        $actual = Yatzy::yatzyScore([4, 4, 4, 4, 4]);
        self::assertSame($expected, $actual);
        self::assertSame(50, Yatzy::yatzyScore([6, 6, 6, 6, 6]));
        self::assertSame(0, Yatzy::yatzyScore([6, 6, 6, 6, 3]));
    }

    public function test_1s(): void
    {
        self::assertSame(1, (new Yatzy(1, 2, 3, 4, 5))->ones());
        self::assertSame(2, (new Yatzy(1, 2, 1, 4, 5))->ones());
        self::assertSame(0, (new Yatzy(6, 2, 2, 4, 5))->ones());
        self::assertSame(4, (new Yatzy(1, 2, 1, 1, 1))->ones());
    }

    public function test_2s(): void
    {
        self::assertSame(4, (new Yatzy(1, 2, 3, 2, 6))->twos());
        self::assertSame(10, (new Yatzy(2, 2, 2, 2, 2))->twos());
    }

    public function test_3s(): void
    {
        self::assertSame(6, (new Yatzy(1, 2, 3, 2, 3))->threes());
        self::assertSame(12, (new Yatzy(2, 3, 3, 3, 3))->threes());
    }

    public function test_4s(): void
    {
        self::assertSame(12, (new Yatzy(4, 4, 4, 5, 5))->fours());
        self::assertSame(8, (new Yatzy(4, 4, 5, 5, 5))->fours());
        self::assertSame(4, (new Yatzy(4, 5, 5, 5, 5))->fours());
    }

    public function test_5s(): void
    {
        self::assertSame(10, (new Yatzy(4, 4, 4, 5, 5))->fives());
        self::assertSame(15, (new Yatzy(4, 4, 5, 5, 5))->fives());
        self::assertSame(20, (new Yatzy(4, 5, 5, 5, 5))->fives());
    }

    public function test_6s(): void
    {
        self::assertSame(0, (new Yatzy(4, 4, 4, 5, 5))->sixes());
        self::assertSame(6, (new Yatzy(4, 4, 6, 5, 5))->sixes());
        self::assertSame(18, (new Yatzy(6, 5, 6, 6, 5))->sixes());
    }

    public function test_one_pair(): void
    {
        self::assertSame(6, Yatzy::score_pair(3, 4, 3, 5, 6));
        self::assertSame(10, Yatzy::score_pair(5, 3, 3, 3, 5));
        self::assertSame(12, Yatzy::score_pair(5, 3, 6, 6, 5));
    }

    public function test_two_Pair(): void
    {
        self::assertSame(16, Yatzy::two_pair(3, 3, 5, 4, 5));
        self::assertSame(18, Yatzy::two_pair(3, 3, 6, 6, 6));
        self::assertSame(0, Yatzy::two_pair(3, 3, 6, 5, 4));
    }

    public function test_three_of_a_kind(): void
    {
        self::assertSame(9, Yatzy::three_of_a_kind(3, 3, 3, 4, 5));
        self::assertSame(15, Yatzy::three_of_a_kind(5, 3, 5, 4, 5));
        self::assertSame(9, Yatzy::three_of_a_kind(3, 3, 3, 2, 1));
    }

    public function test_smallStraight(): void
    {
        self::assertSame(15, Yatzy::smallStraight(1, 2, 3, 4, 5));
        self::assertSame(15, Yatzy::smallStraight(2, 3, 4, 5, 1));
        self::assertSame(0, Yatzy::smallStraight(1, 2, 2, 4, 5));
    }

    public function test_largeStraight(): void
    {
        self::assertSame(20, Yatzy::largeStraight(6, 2, 3, 4, 5));
        self::assertSame(20, Yatzy::largeStraight(2, 3, 4, 5, 6));
        self::assertSame(0, Yatzy::largeStraight(1, 2, 2, 4, 5));
    }

    public function test_fullHouse(): void
    {
        self::assertSame(18, Yatzy::fullHouse(6, 2, 2, 2, 6));
        self::assertSame(0, Yatzy::fullHouse(2, 3, 4, 5, 6));
    }
}
