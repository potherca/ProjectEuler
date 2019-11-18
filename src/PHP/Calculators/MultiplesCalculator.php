<?php

namespace Potherca\ProjectEuler\Calculators
{
    class MultiplesCalculator
    {
        private $multiples;

        final public function __construct(array $multiples)
        {
            $this->multiples = array_map(function ($multiple) {
                return (int) $multiple;
            }, $multiples);
        }

        final public function getMultiplesBelow(int $limit): array
        {
        	$multiples = [];

            for ($counter = 0 ; $counter < $limit; $counter++) {
                if ($this->isMultipleOf($this->multiples, $counter)) {
                    $multiples[] = $counter;
                }
            }
            
            return $multiples;
        }

        final public function getSumOfMultiplesBelow(int $limit): int
        {
            return array_sum($this->getMultiplesBelow($limit));
        }

        private function isMultipleOf(array $targets, int $subject): bool
        {
            return (bool) count(array_filter($targets, function ($target) use ($subject) {
                return $subject % $target === 0;
            }));
        }
    }
}

