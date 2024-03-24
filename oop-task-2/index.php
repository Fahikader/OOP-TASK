<?php
// Include the class.php file which contains the collatzProgram class
require "./class.php";

// Instantiate the collatzProgram class
$fileClass = new collatzProgram();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If "part1" form field is set
    if (isset($_POST["part1"])) {
        // Get the absolute value of the integer from the "part1" field
        $number = abs(intval($_POST["part1"]));
        // Calculate the sequence for the given number
        $sequence = $fileClass->calculateSequence($number);
        // Find the maximum value in the sequence
        $max_value = max($sequence);
        // Count the number of iterations in the sequence
        $iterations = count($sequence) - 1;
    } 
    // If "first_num" and "second_num" form fields are set
    elseif (isset($_POST["first_num"]) && isset($_POST["second_num"])) {
        // Get the absolute values of the integers from the "first_num" and "second_num" fields
        $start = abs(intval($_POST["first_num"]));
        $end = abs(intval($_POST["second_num"]));
        // Calculate the sequences for the range of numbers
        $results = $fileClass->calculateRange($start, $end);
        
        // Check if results are not empty
        if (!empty($results)) {
            // Extract iterations from results
            $iterationsArray = array_column($results, 'iterations');
            
            // Check if iterations array is not empty
            if (!empty($iterationsArray)) {
                // Find minimum and maximum iterations
                $min_iterations = min($iterationsArray);
                $max_iterations = max($iterationsArray);
                
                // Filter numbers with minimum iterations
                $min_numbers = array_filter($results, function($result) use ($min_iterations) {
                    return $result['iterations'] == $min_iterations;
                });
                
                // Filter numbers with maximum iterations
                $max_numbers = array_filter($results, function($result) use ($max_iterations) {
                    return $result['iterations'] == $max_iterations;
                });
            } 
            // Handle case where $iterationsArray is empty
            else {
                $min_iterations = null;
                $max_iterations = null;
                $min_numbers = [];
                $max_numbers = [];
            }
        } 
        // Handle case where $results is empty
        else {
            $min_iterations = null;
            $max_iterations = null;
            $min_numbers = [];
            $max_numbers = [];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>3x + 1 Assignment</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Part 1</h1>
    <form action="" method="POST">
        <input type="number" name="part1" placeholder="Add Positive Number" required>
        <input type="submit" name="submit_part1" value="Submit">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_part1"])): ?>
        <?php if (isset($number)): ?>
            <p>Sequence: <?php echo implode(", ", $sequence); ?></p>
            <p>Maximum Number: <?php echo $max_value; ?></p>
            <p>Iterations: <?php echo $iterations; ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <h1>Part 2</h1>
    <form action="" method="POST">
        <input type="number" name="first_num" placeholder="Start Number" required>
        <input type="number" name="second_num" placeholder="Finish Number" required>
        <input type="submit" name="num_submit" value="Submit">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num_submit"])): ?>
        <?php if (isset($results)): ?>
            <h3>Results:</h3>
            <table>
                <tr>
                    <th>Number</th>
                    <th>Maximum Number</th>
                    <th>Iterations</th>
                </tr>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo $result['number']; ?></td>
                        <td><?php echo $result['max_value']; ?></td>
                        <td><?php echo $result['iterations']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php if (!empty($min_iterations)): ?>
                <p>Minimum Iteration: <?php echo $min_iterations; ?></p>
                <table>
                    <tr>
                        <th>Number</th>
                        <th>Maximum Number</th>
                        <th>Iterations</th>
                    </tr>
                    <?php foreach ($min_numbers as $min_number): ?>
                        <tr>
                            <td><?php echo $min_number['number']; ?></td>
                            <td><?php echo $min_number['max_value']; ?></td>
                            <td><?php echo $min_number['iterations']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <?php if (!empty($max_iterations)): ?>
                <p>Maximum Iteration: <?php echo $max_iterations; ?></p>
                <table>
                    <tr>
                        <th>Number</th>
                        <th>Maximum Number</th>
                        <th>Iterations</th>
                    </tr>
                    <?php foreach ($max_numbers as $max_number): ?>
                        <tr>
                            <td><?php echo $max_number['number']; ?></td>
                            <td><?php echo $max_number['max_value']; ?></td>
                            <td><?php echo $max_number['iterations']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    <?php endif; ?>
    
    <h1>Part 3</h1>
    <form action="./" method="POST">
        <input type="number" name="fstTerm" placeholder="Add First Term" required />
        <input type="number" name="commDiff" placeholder="Add Common Difference" required />
        <input type="number" name="numTerms" placeholder="Add Number of Terms" required />
        <input type="submit" name="calcAP" value="Submit" />
    </form>

    <?php
    if(isset($_POST["calcAP"])){
        $fstTerm = $_POST["fstTerm"];
        $commDiff = $_POST["commDiff"];
        $numterms = $_POST["numTerms"];
		
        // Calculate arithmetic progression sum and series
        $apSum = $fileClass->arithSum
	}
