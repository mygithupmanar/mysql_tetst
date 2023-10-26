<?php
$conn = mysqli_connect("localhost", "root", "@Mydata2023", "testdata");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $id = mysqli_real_escape_string($conn, $data->id);
    
    // Delete the record from the 'xany' table
    $sql = "DELETE FROM `xany` WHERE `id` = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => "Error deleting record: " . mysqli_error($conn)];
    }

    echo json_encode($response);
}

mysqli_close($conn);
?>
