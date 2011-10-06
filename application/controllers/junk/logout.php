<?php

class logout extends Controller
{
    function __Construct()
        {
        show_error('This file has been Depreciated, please use the function in auth');
        exit;
    }
    function index()
    {
        $this->quickauth->logout(); // this doesn't seem to work.
        $this->session->sess_destroy();

        //echo $this->auth->is_logged_in();

        //make sure data destroyed?
        //redirect('login','refresh','10');

        //echo "Successfully logged out</br>";
		redirect('/');
        //print_r($this->session->all_userdata());
			//echo "<a href=\"" . base_folder().index_page()."/login" . "\">Click here to procede</a>";
        //send to login page?
    }
}

?>
