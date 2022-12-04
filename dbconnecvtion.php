<?php

$host = 'hakeemsulyman.com';
$dbUsername = 'hakeemsu_hakeemsulyman';
$dbPassword = 'BerlinMeet';
$dbName = 'hakeemsu_berlinmeet';

//Create Connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die('Could not connect to database.');
}

?>
