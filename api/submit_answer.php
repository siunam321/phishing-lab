<?php
require_once "../inc/connect_db.php";

// Receive JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Response JSON data
$receivedAnswer = htmlspecialchars(trim(strtolower(strval($data["answer"]))));
$receivedTaskNumber = intval($data["taskNumber"]);
$receivedQuestionNumber = intval($data["questionNumber"]);
$receivedLanguage = htmlspecialchars(trim(strtoupper(strval($data["language"]))));

if (isset($receivedAnswer) && isset($receivedTaskNumber) && isset($receivedQuestionNumber) && isset($receivedLanguage)) {
    // Whitelist to filter the incorrect langauge
    $arrayAllowedLanguages = array("EN", "ZH", "HK");
    if (!in_array($receivedLanguage, $arrayAllowedLanguages)) {
        throw new Exception("Invalid column name");
    }

    // Check the answer is empty first
    $query = "SELECT * FROM tasks WHERE taskNumber=? AND questionNumber=? AND taskAnswer$receivedLanguage IS NULL";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $receivedTaskNumber, $receivedQuestionNumber);
    $stmt->execute();
    $taskEmptyAnswerResult = $stmt->get_result();
    $taskEmptyAnswerRow = $taskEmptyAnswerResult->fetch_assoc();
    
    // If it's empty, return "correct" and exit
    $taskEmptyAnswer = $taskEmptyAnswerRow["taskAnswer" . $receivedLanguage];
    // Found empty answer
    if (is_array($taskEmptyAnswerRow)) {
        echo json_encode("correct");
        $stmt->close();
        die();
    }

    // Then, check the answer is correct
    $query = "SELECT * FROM tasks WHERE taskNumber=? AND questionNumber=? AND taskAnswer$receivedLanguage=?";
    $stmt2 = $conn->prepare($query);
    $stmt2->bind_param('iis', $receivedTaskNumber, $receivedQuestionNumber, $receivedAnswer);
    $stmt2->execute();
    $taskCorrectAnswerResult = $stmt2->get_result();
    $taskCorrectAnswerRow = $taskCorrectAnswerResult->fetch_assoc();

    // Found correct answer
    if (is_array($taskCorrectAnswerRow)) {
        echo json_encode("correct");
        $stmt2->close();
        die();
    } else {
        echo json_encode("incorrect");
    }

    endDBConnection();
}
?>