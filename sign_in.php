<?php

require("./database.php");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM tbluser";

$result = $connection->query($query);

$data = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $result->close();
} else {
    echo "Error: " . $connection->error;
}

$connection->close();

header("Content-Type: application/json");

echo json_encode($data);
?>
