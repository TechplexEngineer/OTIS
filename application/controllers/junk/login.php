<?php

class Login extends Controller
{

	function __construct()
	{
            show_error('This file has been depreciated');
            exit;
		parent::Controller();
		if ($this->quickauth->is_logged_in())
		{//The user is not logged in
			redirect('dashboard');
		}
	}

	function index()
	{
		//echo "on login page";
		if ($this->quickauth->is_logged_in())
		{
			echo "You are already logged in <br>";
			//$this->route->item('default_controller')
			echo "<a href=\"" . "dashboard" . "\">Click here to procede</a>";
		} else
		{
			//else show login form
			$this->_loginPage();
		}
	}

	function _loginPage()
	{
		//send config vars as data array
		$this->load->view('login.v.php');
	}

	//This function is where users trying to access pages will be directed
	// so that after authentication, they can be send to their destination.
	function page($to)
	{
		if (isset($to))
		{
			$newdata = array('goto' => $to);
			$this->session->set_userdata($newdata);
		}
		$this->_loginPage();
	}

	function auth()
	{
		//Use post data
		//print_r($_POST);
		$username = stripslashes($_POST['user']);
		$password = stripslashes($_POST['passwd']);

		//@todo Robust database access.
		mysql_connect('localhost', 'OIS', 'informatics');
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);


		if ($this->quickauth->login($username, $password))
		{
			$to = $this->session->userdata('goto');
			//echo $to;
			//remove page session var
			$this->session->unset_userdata('goto');
			redirect($to, 'refresh');

			echo "successfully logged in";
		}
		else
			die("Your username or password is incorrect.");
		
	}
        function help()
        {
            $this->load->view('help.v.php');
        }
        function forgot_password()
        {
            $this->load->view('forgot.v.php');
        }
        function forgot_username()
        {

        }
        function email_me()
        {
            print_r($_POST);
            //$_POST['']
        }

}

?>
