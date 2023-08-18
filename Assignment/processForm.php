<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $storedUserID = $_SESSION["userID"];
    $receiverUserID = $_POST["receiver"];
    $amount = $_POST["amount"];        

    $requests = json_decode(file_get_contents("pendingRequest.json"), true);

    $requestId = uniqid();
        
    $requestData = array(
        "requestId" => $requestId,
        "sender" => $storedUserID,
        "receiver" => $receiverUserID,
        "amount" => $amount,
        "voteCount" => 0,
        "approved" => false,
        "approvedBy" => []
    );
    
    $requests[] = $requestData;
    
    $jsonData = json_encode($requests, JSON_PRETTY_PRINT);
    file_put_contents("pendingRequest.json", $jsonData);
    header("location: clientDashboard.php");
}

?>