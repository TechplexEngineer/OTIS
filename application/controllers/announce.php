<?php

class announce extends Controller {

    function __construct() {
	parent::Controller();
	$this->quickauth->restrict("admin");
    }

    function index() { // archive of past announcments
	$this->quickauth->restrict("auth");
	$this->template->write_view('nav', 'parts/nav.php', NULL, true);
	$this->template->write_view('body', 'announce.v.php', null, true);
	$this->template->render();
    }

    function admin($function=null, $data=null) {
	if ($function == null) {
	    $this->template->write_view('nav', 'parts/nav.php', NULL, true);
	    $this->template->write_view('body', 'admin/a.announce.v.php', null, true);
	    $this->template->render();
	} elseif ($function == "create") {
	    $this->_create($data);
	} elseif ($function == "edit") {
	    $this->_edit($data);
	} elseif ($function == "update") {
	    $this->_update($data);
	}
    }
    function _create()
    {
	
    }
    function _edit()
    {

    }
    function _update() // process the post and interacts with the model
    {

    }

}

?>
