<?php

namespace Training\TheUnusual;

/**
 * Given number N, between 1 and 1000000 inclusive, find the last digit of the function
 *
 * f(N) = 1^2 + 2^3 + 3^4 + ... + N^(N+1)
 * Limits: execution time within one millisecond or less
 */
class LastDigit
{
    /**
     * @param int $number
     * @return int
     */
    public function execute(int $number): int
    {
        $result = 0;

        for ($i = 1; $i <= $number; $i++) {
            $raised = pow($i, $i+1);
            $result += $raised;
        }

        return $result % 10;
    }
}