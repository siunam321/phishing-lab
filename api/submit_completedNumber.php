<?php
require_once "../inc/connect_db.php";

// Receive JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Response JSON data
if (!empty($data)) {
    // Increase 1
    $completedQuery = "UPDATE completedNumber SET completedNumber = completedNumber + 1 WHERE completedId = 1";
    $stmt = $conn->prepare($completedQuery);
    $stmt->execute();
    $stmt->close();

    $fetchCompletedNumber = "SELECT completedNumber FROM completedNumber";
    $stmt2 = $conn->prepare($fetchCompletedNumber);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();

    echo json_encode($row["completedNumber"]);

    // Close database connection & prepare statement
    $stmt2->close();
    endDBConnection();
}
?>