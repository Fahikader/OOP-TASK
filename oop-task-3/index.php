<?php
require "./class.php";

$fileClass = new collatzProgram();
$data = [];
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["part1"])) {
        // Code for Part 1
    } elseif (isset($_POST["first_num"]) && isset($_POST["second_num"])) {
        // Code for Part 2
        $start = abs(intval($_POST["first_num"]));
        $end = abs(intval($_POST["second_num"]));
        $results = $fileClass->calculateRange($start, $end);

        // Calculate histogram data
        $dataArray = [];
        foreach ($results as $result) {
            $dataArray[] = $result["iterations"];
        }

        $dataObj = new calculatestatic();
        $data = $dataObj->histogramdisplay($dataArray);
        ksort($data);
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
.histogram {
	display: flex;
	align-items: flex-end;
	min-height: 100px;
}
.bar {
	background-color: #007bff;
	margin-right: 2px;
	color: white;
	padding: 0px 5px 10px 5px;
}
</style>
</head>
<body>
    <h1>Part 1</h1>
    <form action="" method="POST">
        <input type="number" name="part1" placeholder="Add Positive Number" required>
        <input type="submit" name="submit_part1" value="Submit">
    </form>

    <!-- Display results for Part 1 here -->

    <h1>Part 2</h1>
    <form action="" method="POST">
        <input type="number" name="first_num" placeholder="Start Number" required>
        <input type="number" name="second_num" placeholder="Finish Number" required>
        <input type="submit" name="num_submit" value="Submit">
    </form>
	
	<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num_submit"]) && !empty($results)): ?>
        <h3> HISTOGRAM FOR ITERATION </h3>
        <div class='histogram'>
            <?php foreach ($data as $dataIndex => $dataValue): ?>
                <div class='bar' style='height:<?php echo $dataValue; ?>0px;' title='x:<?php echo $dataIndex; ?>, y:<?php echo $dataValue; ?>'><small><?php echo $dataIndex . ":" . $dataValue; ?></small></div>
            <?php endforeach; ?>
        </div>
        <p>[x(iteration):y(frequency)]</p>
    <?php endif; ?>
	
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num_submit"])): ?>
        <?php if (!empty($results)): ?>
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

    <!-- Display results for Part 3 -->

</body>
</html>
