<?php
//session_start(); //not sure if i need this or not //I Do since its an external file
// This file is requested using ajax from the main dashboard because it takes so long to load,
// as to not slow down the usage of the rest of the page.

if (!empty($_GET['name']))
{
	if (empty($_SESSION['fhrs']))
	{
		//die ($col);
		include "../../helpers/gdata_helper.php";
		// GetCollumn of which C#R1 = users name
		$row = getRow($_GET['name']);

        
		//die($row);
		if ($row == "error")
		{
			//@todo send email when stats aren't loaded
			//include "mail.php";
			//mailer("blake@team2648.com", "User Missing From Database Error", $_GET['name']."'s hours are not loading please check into that.");
			die("Sorry, Your stats couldn't be loaded.");
		}
		//@todo sned message to blake
		//@todo account approval
		//die("robert");
		// then get cell from each of the sheets for that user,
		// assuming they are in the same column of each sheet
//		$s1 = getcell($row, 2, 1);
//		$s2 = getcell($row, 3, 1);
//		$s3 = getcell($row, 4, 1);
//		$s4 = getcell($row, 5, 1);

        $hours    = getcell($row, 2, 1);
        $contract = getcell($row, 3, 1);


		// Store my loot in the session varibles,
		// so next time I want this, I don't need to fetch it
//		$_SESSION['fhrs'] = $s1;
//		$_SESSION['fdol'] = $s2;
//		$_SESSION['chrs'] = $s3;
//		$_SESSION['bhrs'] = $s4;
	}
}
//print_r($_SESSION);


echo '<strong>You have:</strong><br/>';
echo '<ul style="padding-left: 10px;">';

echo '<li>'. $hours .' of 30 fundraising hours</li>';


echo '<li>';
if($contract == "yes")
    echo 'Ms Luce has your contract :)';
else
    echo 'You still need to turn in your <a target="_blank" href="https://docs.google.com/document/d/12M-9tBwch911HvKEbvU-6W5bBdCsefiyxIFTd5ggnHg/edit?hl=en_US">contract</a>';

echo '</li>';

echo '</ul>';

?>

