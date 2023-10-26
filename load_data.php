<?php
$conn = mysqli_connect("localhost", "root", "@Mydata2023", "testdata");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$data = array();

// Retrieve x and y values from the 'xany' table
$sql = "SELECT * FROM `xany`";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array('x' => $row['x'], 'y' => $row['y']);
    }

    // Return the data as JSON
    echo json_encode($data);
} else {
    echo "Error retrieving data: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
