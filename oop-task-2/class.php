<?php

class collatzProgram {
    // Array to store the result of the Collatz sequence
    public $seqResult = array();
    
    // Array to store the results of the range of numbers
    public $rangeResult = array();
    
    // Variable to store the arithmetic progression sum
    public $arthSum = 0;
    
    // Array to store the arithmetic progression series
    public $arthSeries = array();
    
    // Method to calculate the Collatz sequence for a given number
    public function calculateSequence($number) {
        // Initialize the sequence array with the given number
        $sequence = array($number);
        
        // Continue the sequence until reaching 1
        while ($number != 1) {
            if ($number % 2 == 0) {
                $number /= 2;
            } else {
                $number = 3 * $number + 1;
            }
            // Add the next number in the sequence to the array
            $sequence[] = $number;
        }
        
        // Store the sequence result in the class variable and return it
        $this->seqResult = $sequence;
        return $this->seqResult;
    }
    
    // Method to calculate the Collatz sequences for a range of numbers
    public function calculateRange($start, $end) {
        // Array to store results for each number in the range
        $results = array();
        
        // Iterate through each number in the range
        for ($i = $start; $i <= $end; $i++) {
            // Calculate the Collatz sequence for the current number
            $sequence = $this->calculateSequence($i);
            // Find the maximum value in the sequence
            $max_value = max($sequence);
            // Count the number of iterations in the sequence
            $iterations = count($sequence) - 1;
            // Store the results for the current number in the results array
            $results[] = array("number" => $i, "max_value" => $max_value, "iterations" => $iterations);
        }
        
        // Store the range results in the class variable and return them
        $this->rangeResult = $results;
        return $this->rangeResult;
    }
    
    // Method to calculate the sum of an arithmetic progression
    public function arithSum($fstTerm, $commDiff, $numterms) {
        // Calculate the sum using the arithmetic progression formula
        $sum = ($numterms / 2) * (2 * $fstTerm + ($numterms - 1) * $commDiff);
        // Store the sum in the class variable and return it
        $this->arthSum = $sum;
        return $this->arthSum;
    }
    
    // Method to calculate the series of an arithmetic progression
    public function arithSeries($fstTerm, $commDiff, $numterms) {
        // Array to store the arithmetic progression series
        $series = array();
        // Initialize the current term with the first term
        $current_term = $fstTerm;
        
        // Iterate through the number of terms and calculate each term
        for($i = 0; $i < $numterms; $i++) {
            // Add the current term to the series array
            $series[] = $current_term;
            // Calculate the next term by adding the common difference
            $current_term = $current_term + $commDiff;
        }
        
        // Store the series in the class variable and return it
        $this->arthSeries = $series;
        return $this->arthSeries;
    }
}

?>
