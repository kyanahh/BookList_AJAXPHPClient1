<?php

require("./database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
   	$password = $_POST["password"];

    $sql = "INSERT INTO tbluser (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
        if ($stmt->execute()) {
 
            $response = "Registration successful.";
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
