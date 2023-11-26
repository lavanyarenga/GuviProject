<?php
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];

    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ? LIMIT 1");

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($name, $email);
            $stmt->fetch();

            echo json_encode(["success" => true, "name" => $name, "email" => $email]);
        } else {
            echo json_encode(["success" => false, "message" => "User not found"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error: Unable to prepare statement"]);
    }
}

$conn->close();
?>
