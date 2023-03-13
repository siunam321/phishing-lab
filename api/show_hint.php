<?php
require_once "../inc/connect_db.php";

// Receive JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Response JSON data
$receivedHintTaskNumber = intval($data["hintTaskNumber"]);
$receivedHintQuestionNumber = intval($data["hintQuestionNumber"]);

if (isset($receivedHintTaskNumber) && isset($receivedHintQuestionNumber)) {
    // Fetch hint content from table tasks with prepare statement
    $hintQuery = "SELECT * FROM tasks WHERE taskNumber=? AND questionNumber=?";
    $stmt = $conn->prepare($hintQuery);
    $stmt->bind_param('ii', $receivedHintTaskNumber, $receivedHintQuestionNumber);
    $stmt->execute();
    $hintQueryResult = $stmt->get_result();
    $hintResult = $hintQueryResult->fetch_assoc();

    if ($data["language"] == "zh") {
        echo json_encode($hintResult["questionHintZH"]);
    } elseif ($data["language"] == "hk") {
        echo json_encode($hintResult["questionHintHK"]);
    } else {
        // Default send English hint
        echo json_encode($hintResult["questionHint"]);
    }
    
    // Close database connection & prepare statement
    $stmt->close();
    endDBConnection();
}
?>