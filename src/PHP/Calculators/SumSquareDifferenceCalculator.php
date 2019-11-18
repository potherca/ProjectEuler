namespace Potherca\ProjectEuler\Calculators
{
    class SumSquareDifferenceCalculator
    {
        final public function getSumSquareDifference(int $limit): int
        {
        	return $this->getSquareOfSums($limit) - $this->getSumOfSquares($limit);
        }

        private function getSquareOfSums(int $limit): int
        {
        	return array_sum(range(1, $limit)) ** 2;
        }

        private function getSumOfSquares(int $limit): int
        {
        	$numbers = range(1, $limit);

        	$squares = array_map(function ($number) {
        		return $number ** 2;
        	}, $numbers);
        	
        	return array_sum($squares);
        }
    }
}
