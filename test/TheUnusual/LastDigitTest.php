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

    public function testExecute(): void
    {
        $this->assertTrue(true);
    }


}