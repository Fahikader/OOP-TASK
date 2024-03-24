<?php

function calculate_sequence($number) {
    $sequence = array($number);

    while ($number != 1) {
        if ($number % 2 == 0) {
            $number /= 2;
        } else {
            $number = 3 * $number + 1;
        }
        $sequence[] = $number;
    }

    return $sequence;
}

function calculate_range($start, $end) {
    $results = array();

    for ($i = $start; $i <= $end; $i++) {
        $sequence = calculate_sequence($i);
        $max_value = max($sequence);
        $iterations = count($sequence) - 1;
        $results[] = array("number" => $i, "max_value" => $max_value, "iterations" => $iterations);
    }

    return $results;
}

?>