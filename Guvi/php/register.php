<?php
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: Unable to register"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error: Unable to prepare statement"]);
    }
}

$conn->close();
?>
