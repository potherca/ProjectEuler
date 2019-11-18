<?php

namespace Potherca\ProjectEuler\Calculators
{
    class PalindromeProductCalculator
    {
        final public function getHighestPalindromeForProduct(int $digits): int
        {
        	$palindromes = $this->getPalindromesForProduct($digits);

        	return end($palindromes);
        }

        final public function getPalindromesForProduct(int $digits): array
        {
        	$low = 10 ** ($digits - 1);
        	$high = (10 ** $digits) - 1;

        	return $this->getPalindromesForRange($low, $high);
        }

        final public function getPalindromesForRange(int $low, int $high): array
        {
			$palindromes = [];

			$numbers = range($low, $high);

			foreach ($numbers as $left) {
				foreach ($numbers as $right) {
                    // @TODO: An optimisation can be added here to not do double calculations
                    //        Where ($left * $right) === ($right * $left)

                    $number = $left * $right;

					$reverse = (int) strrev($number);

					if (
						$reverse === $number
						&& ! in_array($number, $palindromes)
					) {
						$palindromes[] = $number;
					}
				}
			}

			sort($palindromes);

			return $palindromes;
        }
    }
}
