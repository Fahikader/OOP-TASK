<?php
require "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["part1"])) {
        $number = abs(intval($_POST["part1"]));
        $sequence = calculate_sequence($number);
        $max_value = max($sequence);
        $iterations = count($sequence) - 1;
    } elseif (isset($_POST["first_num"]) && isset($_POST["second_num"])) {
        $start = abs(intval($_POST["first_num"]));
        $end = abs(intval($_POST["second_num"]));
        $results = calculate_range($start, $end);
        
        if (!empty($results)) {
            $iterationsArray = array_column($results, 'iterations');
            
            if (!empty($iterationsArray)) {
                $min_iterations = min($iterationsArray);
                $max_iterations = max($iterationsArray);
                
                $min_numbers = array_filter($results, function($result) use ($min_iterations) {
                    return $result['iterations'] == $min_iterations;
                });
                
                $max_numbers = array_filter($results, function($result) use ($max_iterations) {
                    return $result['iterations'] == $max_iterations;
                });
            } else {
                // Handle case where $iterationsArray is empty
                $min_iterations = null;
                $max_iterations = null;
                $min_numbers = [];
                $max_numbers = [];
            }
        } else {
            // Handle case where $results is empty
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
</body>
</html>
