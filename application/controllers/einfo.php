<?php

/**
 * Description of EContactInfo
 *
 * @author Techplex.Engineer
 */
class Einfo extends Controller {

    function __Construct() {
	parent::Controller();
	$this->load->model('user_model', 'um');
	$this->quickauth->restrict("mentor");
    }

    function index() {

	$this->template->write_view('nav', 'parts/nav.php', NULL, true);
	$this->template->write('body', '', true);
	//$this->template->write_view('body', '',true);
	for( $i= 1; $i < 49; $i++)
	{
	    $row = null;
	    $name = $this->um->ID2FullName($i, " ");
	    if($name != '' && $name != ' ' && !empty($name) && isset($name))
	    {
	    $row = $this->um->econtact_get($i);
	    //print_r($row);
	    $row["act"]="test";
	    $row["actName"]=$name;
	    $this->template->write_view('body', 'e.econtact.v.php', $row, false);
	    }
	}

//	$fields = $this->um->getCols('econtact');
//
//	//this fill emptyies with ' ' a space character
//	$row = blamkify($row, $fields);



	$this->template->render();
    }

}

?>
