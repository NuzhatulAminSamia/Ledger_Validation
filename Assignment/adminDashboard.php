<?php

session_start();

require_once('dbConnection.php');

$currentData = file_get_contents('pendingRequest.json');
$pendingRequests = json_decode($currentData, true);

$approvedData = file_get_contents('approvedRequests.json');
$approvedRequests = json_decode($approvedData, true);

$adminID = $_SESSION["userID"]; 

?>

<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body align="center">
    <h1>Welcome to Admin Dashboard</h1>

    <h2>Pending Requests</h2>
    <table align="center" border=1>
        <tr>
            <th>Request ID</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount</th>
            <th>Vote Count</th>
            <th>Action</th>
        </tr>
        <?php
        if (!$pendingRequests) {
            echo "No data found";
    } else {
        foreach ($pendingRequests as $request) {
            echo "<tr>";
            echo "<td>" . $request["requestId"] . "</td>";
            echo "<td>" . $request["sender"] . "</td>";
            echo "<td>" . $request["receiver"] . "</td>"; 
            echo "<td>" . $request["amount"] . "</td>";   
            echo "<td>" . $request["voteCount"] . "</td>";
            echo "<td>";
            if (!isset($request["approvedBy"][$adminID]) || !$request["approvedBy"][$adminID]) {
                echo "<a href='approveRequest.php?reqId=" . $request["requestId"] . "'>Approve</a>";
            } else {
                echo "Approved";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
    </table>
    <h2>Approved Requests</h2>
    <table align="center" border=1>
        <tr>
            <th>Request ID</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount</th>
            <th>Vote Count</th>
        </tr>
        <?php
        if(!$approvedRequests)
        {
            echo "No data found";
        }
        else
        {
            foreach ($approvedRequests as $request) {
                echo "<tr>";
                echo "<td>" . $request["requestId"] . "</td>";
                echo "<td>" . $request["sender"] . "</td>";
                echo "<td>" . $request["receiver"] . "</td>";
                echo "<td>" . $request["amount"] . "</td>";
                echo "<td>" . $request["voteCount"] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <p align="center"><br><br><br><br><br><br><br><br><br><br><a href="logout.php"><button>Logout</button></a></p>
</body>

</html>