<?php

class collatzProgram {
  public $max_value = 0;
  public $iterations = 0;

  public function calculateSequence($number) {
    $sequence = array($number);

    while ($number != 1) {
      if ($number % 2 == 0) {
        $number /= 2;
      } else {
        $number = 3 * $number + 1;
      }
      // Update max_value if needed
      $this->max_value = max($this->max_value, $number);
      $sequence[] = $number;
    }

    $this->iterations = count($sequence) - 1;
    return $sequence;
  }

  public function calculateRange($start, $end) {
    $results = array();

    for ($i = $start; $i <= $end; $i++) {
      $this->max_value = 0; // Reset for each calculation
      $this->iterations = 0;
      $this->calculateSequence($i);
      $results[] = array("number" => $i, "max_value" => $this->max_value, "iterations" => $this->iterations);
    }

    return $results;
  }

  public function arithmeticSum($fstTerm, $commDiff, $numterms) {
    $sum = ($numterms / 2) * (2 * $fstTerm + ($numterms - 1) * $commDiff);
    return $sum;
  }

  public function arithmeticSeries($fstTerm, $commDiff, $numterms) {
    $series = array();
    $current_term = $fstTerm;

    for($i = 0; $i < $numterms; $i++){
      $series[] = $current_term;
      $current_term = $current_term + $commDiff;
    }

    return $series;
  }
}

class calculatestatic extends collatzProgram {
  public function histogramdisplay($m) {
    $Iterationcount = array_count_values($m);
    return $Iterationcount;
  }
}

?>
