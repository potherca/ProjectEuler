<?php

namespace Potherca\ProjectEuler\Calculators
{
    class SumSquareDifferenceCalculator
    {
        final public function getSumSquareDifference(int $limit): int
        {
            $range = range(1, $limit);

            return $this->getSquareOfSums($range) - $this->getSumOfSquares($range);
        }

        private function getSquareOfSums(array $range): int
        {
        	return array_sum($range) ** 2;
        }

        private function getSumOfSquares(array $range): int
        {
        	return array_sum(
        		array_map(function ($number) {
        			return $number ** 2;
        		}, $range)
        	);
        }
    }
}
