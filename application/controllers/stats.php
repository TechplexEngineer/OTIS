<?php

/*
 * This file is part of the OTIS project. All Rights Reserved.
 */

/**
 * Description of stats
 *
 * @author Techplex.Engineer
 */
class Stats extends Controller {

    function __Construct() {
	parent::Controller();
	$this->quickauth->restrict();
    }

    function index() {
	$FH = $this->session->userdata('fundHours');
	if (!empty($FH)) {
	    $data['fundHours'] = $this->session->userdata('fundHours');
	    $data['fundDollars'] = $this->session->userdata('fundDollars');
	    $data['comService'] = $this->session->userdata('comService');
	    $data['buildHours'] = $this->session->userdata('buildHours');
	     $data['driveMins'] = $this->session->userdata('driveMins');;
	} else {
	    $name = $this->session->userdata('firstname') . " " . $this->session->userdata('lastname');
	    // GetCollumn of which C#R1 = users name
	    $row = getRow($name);
	    if ($row == "error") {
		//@todo send email when stats aren't loaded
		//include "mail.php";
		//mailer("blake@team2648.com", "User Missing From Database Error", $_GET['name']."'s hours are not loading please check into that.");
		die("Sorry, Your stats couldn't be loaded.");
	    }
	    //@todo send message to blake
	    //@todo account approval
	    // then get cell from each of the sheets for that user,
	    // assuming they are in the same column of each sheet
	    $fundHours = getcell($row, 2, 1);
	    $fundDollars = getcell($row, 3, 1);
	    $comService = getcell($row, 4, 1);
	    $buildHours = getcell($row, 5, 1);
	    $driveMins = getcell($row, 6, 1);
	    
	    $data['fundHours'] = $fundHours;
	    $data['fundDollars'] = $fundDollars;
	    $data['comService'] = $comService;
	    $data['buildHours'] = $buildHours;
	    $data['driveMins'] = $driveMins;

	    $this->session->set_userdata($data);
	}
	$this->template->write_view('nav', 'parts/nav.php', NULL, true);
	$this->template->write_view('body', 'stats.v.php', $data, true);
	$this->template->render();
    }

}

?>