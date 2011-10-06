<?php

class About extends Controller {

    function __construct() {
	parent::Controller();
    }
    function index()
    {
	$this->template->write('nav', anchor('/',"Back"), NULL, true);
	$this->template->write_view('body', 'about.v.php', null, true);
	//$this->template->write('body', 'Admin Area <br>', true);
	//$this->template->write('body', anchor('admin/user_edit', "view accts"), false);
	$this->template->render();
    }
}

?>
