<?php
// Get user's browser language
$browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

// Get user's region for redirecting to which language page 
$userIPAddress = $_SERVER['REMOTE_ADDR'];
// $userRegion = file_get_contents("https://api.hostip.info/country.php?ip=$userIPAddress");
$responseJson = file_get_contents("http://ip-api.com/json/$userIPAddress?fields=countryCode");
$responseArray = json_decode($responseJson, true);
$userRegion = $responseArray["countryCode"];

if ($userRegion === 'HK' || $userRegion === 'MO') {
    // Redirect to Cantonese index page
    // Change to 301 permanent redirect
    // See https://support.google.com/webmasters/thread/164741153/false-positive-from-sso?hl=en for more information
    header("Location: https://phishing-lab.infinityfreeapp.com/hk/", true, 301);
    die();
} elseif ($browserLanguage === "zh" || $userRegion === 'TW' || $userRegion === 'CN') {
    // Redirect to Traditional Chinese index page
    header("Location: https://phishing-lab.infinityfreeapp.com/zh/", true, 301);
    die();
} else {
    // Default redirect to English language one
    header("Location: https://phishing-lab.infinityfreeapp.com/en/", true, 301);
    die();
}
?>