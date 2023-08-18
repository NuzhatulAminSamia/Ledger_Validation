<?php

session_start();

require_once('dbConnection.php');


$clientID = $_SESSION["userID"];

$requests = [];
$pendingRequestFile = "pendingRequest.json";

if (file_exists($pendingRequestFile)) {
    $jsonData = file_get_contents($pendingRequestFile);
    if ($jsonData !== false) {
        $requests = json_decode($jsonData, true);
    }
}
?>

<html>

<head>
    <title>Money Transfer Form</title>
</head>

<body>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form align="center" method="post" action="processForm.php">
        <h2>Request Money Transfer</h2>
        <input type="text" class="textBox" id="receiver" name="receiver" placeholder="Receiver"><br><br>
        <input type="text" class="textBox" id="amount" name="amount" placeholder="Amount"><br><br>
        <input type="password" class="textBox" id="pin" name="pin" placeholder="PIN"><br><br>
        <input type="submit" value="Send Money">
    </form>
    <p align="center"><a href="logout.php"><button>Logout</button></a></p>
</body>

</html>