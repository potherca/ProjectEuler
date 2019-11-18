<?php

/**
 * Project Euler Problem 1: Multiples of 3 and 5
 * 
 * If we list all the natural numbers below 10 that are multiples of 3 or 5, we
 * get 3, 5, 6 and 9. The sum of these multiples is 23.
 * 
 * Find the sum of all the multiples of 3 or 5 below 1000.
 * 
 * Problem: https://projecteuler.net/problem=1
 * Solution: https://github.com/potherca-blog/ProjectEuler/blob/master/src/PHP/Solutions/Problem001.php
 * Live code: https://ideone.com/ViI6sA
 */
namespace Potherca\ProjectEuler\Solutions\Problem001
{
    use Potherca\ProjectEuler\Calculators\MultiplesCalculator as Calculator;

    $multiples = [3, 5];
    $limit = 1000;

    $solutions = (new Calculator($multiples))->getSumOfMultiplesBelow($limit);
    
    echo $solutions;
}
