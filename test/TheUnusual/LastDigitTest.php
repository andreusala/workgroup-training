<?php

namespace Training\Test\TheUnusual;

use PHPUnit\Framework\TestCase;
use Training\TheUnusual\LastDigit;

class LastDigitTest extends TestCase
{
    private LastDigit $lastDigit;

    protected function setUp(): void
    {
        $this->lastDigit = new LastDigit();
    }

    /**
     * @dataProvider lastDigitProvider
     *
     * @param int $number
     * @param int $lastDigit
     * @return void
     */
    public function testExecute(int $number, int $lastDigit): void
    {
        $result = $this->lastDigit->execute($number);
        $this->assertEquals($result, $lastDigit);
    }

    /**
     * @return int[]
     */
    public function lastDigitProvider(): array
    {
        return [
            [1, 1],
            [2, 9],
            [3, 0],
            [4, 4],
            [5, 9],
            [6, 5],
            [7, 6],
            [10, 5],
            [100, 0],
            [1000000, 0],
        ];
    }
}