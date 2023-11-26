<?php
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ? LIMIT 1");

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($userId, $hashedPassword);
            $stmt->fetch();

            if ($password == $hashedPassword) {
                echo json_encode(["success" => true, "userId" => $userId]);
            } else {
                echo json_encode(["success" => false, "message" => "Invalid email or password"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid email or password"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error: Unable to prepare statement"]);
    }
}

$conn->close();
?>
