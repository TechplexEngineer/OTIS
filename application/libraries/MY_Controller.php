<?php

class MY_Controller extends Controller
{
    var $logged_in = false;
    function  __Construct()
    {
        parent::Controller();

        //$this->test();
    }
    function test()
    { // if not logged, make them login.
        if(!$this->_logged_in())
                $this->login();
    }

    function _logged_in()
    {
        return $this->logged_in;
    }
    function logout()
    {
        $this->logged_in = FALSE;
    }
    
    function login()
    {
        //call login view
        //echo "call login view";
	$this->load->view('login.v.php');
        //$this->logged_in = TRUE;
        //exit;
    }
}
?>
