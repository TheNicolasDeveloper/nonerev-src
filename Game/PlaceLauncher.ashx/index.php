<?php
header('Content-Type: application/json');

require_once $_SERVER["DOCUMENT_ROOT"] . "/config/main.php";

$authticket = isset($_COOKIE["_ROBLOSECURITY"]) ? $_COOKIE["_ROBLOSECURITY"] : "uh oh idfk cookie not defined >:(";


$authclass = new Auth;

$ticket = $authclass->validateToken($authticket);

if (!$ticket) {
    header("HTTP/1.1 401 Unauthorized");
    header("Content-Type: text/plain");
    echo "invalid auth ticket";
    error_log("invalid auth ticket".$authticket.$_COOKIE);
    exit;
}

$array = array( // json by cozmo, put into an array by codeium, edited
    "jobId" => "testing123",
    "status" => 2,
    "joinScriptUrl" => "http://www.r3x.ct8.pl/Game/Join.ashx?token=" . $authticket,
    "authenticationUrl" => "https://r3x.ct8.pl/Login/Negotiate.ashx",
    "authenticationTicket" => $authticket,
    "message" => "success"
);

exit(json_encode($array));


// JSON BY COZMO :D (TYSM! NO PROBLEM!). REMOVE THIS EPIC CREDITS AND YOURE DEAD MEAT

//{"jobId":"testing123","status":2,"joinScriptUrl":"http://www.r3x.ct8.pl/Game/Join.ashx","authenticationUrl":"https://r3x.ct8.pl/Login/Negotiate.ashx","authenticationTicket": "real","message":"success"}