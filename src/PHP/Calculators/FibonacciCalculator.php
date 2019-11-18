<?php

namespace Potherca\ProjectEuler\Calculators
{
    class FibonacciCalculator
    {
        final public function getSumOfEvenTermsBelow(int $limit): int
        {
            return array_sum($this->getEvenTermsBelow($limit));
        }

        final public function getEvenTermsBelow(int $limit): array
        {
        	return array_filter($this->getTermsBelow($limit), function ($term) {
        		return $term % 2 === 0;
        	});
        }

        final public function getTermsBelow(int $limit): array
        {
        	$terms = [];

        	$previousTerm = 0;
            $currentTerm = 1;

        	while ($previousTerm + $currentTerm < $limit) {
	        	$term = $previousTerm + $currentTerm;

        		$terms[] = $term;
        		
        		$previousTerm = $currentTerm;
        		$currentTerm = $term;
        	};
        	
        	return $terms;
        }
    }
}
