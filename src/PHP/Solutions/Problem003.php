<?php

/**
 * Project Euler Problem 3: Largest prime factor
 * 
 * The prime factors of 13195 are 5, 7, 13 and 29.
 * 
 * What is the largest prime factor of the number 600851475143 ?
 * 
 * Problem: https://projecteuler.net/problem=3
 * Solution: https://github.com/potherca-blog/ProjectEuler/blob/master/src/PHP/Solutions/Problem003.php
 * Live code: https://ideone.com/O2tMUJ
 */
namespace Potherca\ProjectEuler\Solutions\Problem003
{
    use Potherca\ProjectEuler\Calculators\PrimeFactorCalculator as Calculator;

    $number = 600851475143;

    $solution = (new Calculator())->getLargestPrimeFactor($number);
    
    echo $solution;
}
