<?php
require("./database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $booktitle = $_POST["booktitle"];
    $author = $_POST["author"];
    $yearpub = $_POST["yearpub"];

    $sql = "UPDATE tblbooks SET bookname=?, author=?, yearbook=? WHERE bookid=?";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("sssi", $booktitle, $author, $yearpub, $id);
        if ($stmt->execute()) {
            $response = "Book updated successfully.";
        } else {
            $response = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response = "Error: " . $connection->error;
    }

    $connection->close();

    echo $response;
} else {
    echo "Invalid request method.";
}
?>
