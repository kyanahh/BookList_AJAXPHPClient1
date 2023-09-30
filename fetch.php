<?php

require("./database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "SELECT bookid, bookname, author, yearbook FROM tblbooks WHERE bookid = ?";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->bind_result($fetchedId, $booktitle, $author, $yearpub);

            if ($stmt->fetch()) {
                $recordData = [
                    "id" => $fetchedId,
                    "bookname" => $booktitle,
                    "author" => $author,
                    "yearbook" => $yearpub,
                ];

                echo json_encode($recordData);
            } else {
                echo "Book not found";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $connection->error;
    }

    $connection->close();
} else {
    echo "Invalid request method.";
}
?>
