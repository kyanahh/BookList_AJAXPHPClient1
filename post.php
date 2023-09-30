<?php

require("./database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booktitle = $_POST["booktitle"];
    $author = $_POST["author"];
    $yearpub = $_POST["yearpub"];
    $id = $_POST["id"];

    $sql = "INSERT INTO tblbooks (bookname, author, yearbook, userid) VALUES (?, ?, ?, ?)";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("sssi", $booktitle, $author, $yearpub, $id);
        if ($stmt->execute()) {
            $response = "Book added successfully.";
        } else {
            $response = "Error adding book: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response = "Error preparing statement: " . $connection->error;
    }

    $connection->close();

    echo $response;
} else {
    echo "Invalid request method.";
}

?>
