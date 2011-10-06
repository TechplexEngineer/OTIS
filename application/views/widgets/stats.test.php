<?php

include "../../helpers/gdata_helper.php";
//$_GET['name']
$row = getRow("Blake Bourque");
echo $row;
if ($row == "error") {
    //@todo send email when stats aren't loaded
    include "mail.php";
    mailer("blake@team2648.com", "User Missing From Database Error", $_GET['name']."'s hours are not loading please check into that.");
    die("Sorry, Your stats couldn't be loaded.");
}

$hours    = getcell($row, 2, 1);
$contract = getcell($row, 3, 1);

echo $hours;
echo $contract;
?>
