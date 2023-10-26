<?php
$conn = mysqli_connect("localhost", "root", "@Mydata2023", "testdata");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Save facility, location, emission unit, test dates, and emission limit
$facility = $_POST['facility'];
$location = $_POST['location'];
$emission_unit = $_POST['emission-unit'];
$test_dates = $_POST['test-dates'];
$emission_limit = $_POST['Emission Limit'];

// Insert the general data into the 'user_data' table
$sql = "INSERT INTO `user_data` (`facility`, `location`, `emission_unit`, `test_dates`, `emission_limit`) 
        VALUES ('$facility', '$location', '$emission_unit', '$test_dates', '$emission_limit')";

if (mysqli_query($conn, $sql)) {
    // The general data has been inserted successfully

    // Retrieve x and y values as arrays
    $xValues = $_POST['x'];
    $yValues = $_POST['y'];

    // Combine x and y values into an array for insertion
    $dataRows = array();
    for ($i = 0; $i < count($xValues); $i++) {
        $x = $xValues[$i];
        $y = $yValues[$i];
        $dataRows[] = "('$x', '$y')";
    }

    // Insert x and y values into the 'xany' table
    $dataSql = "INSERT INTO `xany` (`x`, `y`) VALUES " . implode(',', $dataRows);

    if (mysqli_query($conn, $dataSql)) {
        // The x and y values have been inserted successfully
        echo "Data has been successfully saved!";
    } else {
        echo "Error inserting x and y values: " . mysqli_error($conn);
    }
} else {
    echo "Error inserting general data: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
