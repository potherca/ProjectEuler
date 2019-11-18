<?php

/**
 * Project Euler Problem 4: Largest palindrome product
 * 
 * A palindromic number reads the same both ways. The largest palindrome made 
 * from the product of two 2-digit numbers is 9009 = 91 × 99.
 * 
 * Find the largest palindrome made from the product of two 3-digit numbers.
 * 
 * Problem: https://projecteuler.net/problem=4
 * Solution: https://github.com/potherca-blog/ProjectEuler/blob/master/src/PHP/Solutions/Problem004.php
 * Live code: https://ideone.com/MwUCwn
 */
namespace Potherca\ProjectEuler\Solutions\Problem004
{
    use Potherca\ProjectEuler\Calculators\PalindromeProductCalculator as Calculator;

	$digits = 3;
    
    $solution = (new Calculator())->getHighestPalindromeForProduct($digits);
    
    echo $solution;
}
