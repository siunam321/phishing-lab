<?php
// MySQL credentials
$servername = "{Redacted}";
$dbName = "{Redacted}";
$username = "{Redacted}";
$password = "{Redacted}";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Change character set to UTF-8, so we can display Chinese characters
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} /*else {
    echo "Connected successfully";    
}*/

function endDBConnection() {
    $conn->close();    
}
?>