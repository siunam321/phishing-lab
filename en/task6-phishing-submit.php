<?php
// Receive JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Response JSON data
$receivedPhishingEmail = htmlspecialchars(strval($data["phishingEmail"]));
$receivedPhishingEmailSubject = htmlspecialchars(strval($data["phishingEmailSubject"]));

$keywords = array("Instagram", "Patrick Chan");

if (isset($receivedPhishingEmail) && isset($receivedPhishingEmailSubject)) {
    // Search for key words: "Instagram", "Patrick Chan"
    if (strpos($receivedPhishingEmail, $keywords[0]) && strpos($receivedPhishingEmail, $keywords[1])) { 
        echo json_encode("correct");
    } else {
        echo json_encode("incorrect");
    }
}
?>