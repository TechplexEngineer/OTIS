<?php

class help extends Controller
{

	function __Construct()
	{
		//@todo make this page look better
		parent::Controller();
//        if ($this->quickauth->is_logged_in())
//        {//The user is not logged in
//            redirect('auth/login/help');
//        }
		$this->load->model('io');
		$this->load->helper('mail_helper');
		$this->load->model('user_model');
		$this->template->set_template('deauth');
	}

	function index()
	{
		ui_render();
		echo "Welcome to the help file<br>";
		echo "Do you need help with remembering your username or password?" . anchor('/help/forgot', 'Yes! Please help me');
	}

	function forgot($what=null)
	{
		
		$this->template->write('body','<div class="box">',true);
		$this->template->write('body','<h1> Forgot Something? </h1>',false);
		$this->template->write_view('body','help/forgot.pass.v.php',false);
		$this->template->write_view('body','help/forgot.user.v.php',false);
		$this->template->write('body',anchor('/auth','Back', 'class="button"'),false);
		$this->template->write('body','</div>',false);
		$this->template->render();
	}

	/* This function does a quick and dirty db lookup for the firstname entered.*/
	function fuser()
	{
		$sql = "SELECT * FROM users WHERE firstname='" . $_POST['firstname'] . "'";
		$qry = mysql_query($sql);

		if (mysql_num_rows($qry) > 0)
		{
			echo "<LINK REL=StyleSheet HREF=\"/application/media/css/table.css\" TYPE=\"text/css\" MEDIA=screen>";
			echo "<table class='sample'>";
			echo "<tr>";
			echo "<th> Full Name </th>";
			echo "<th>Username</th>";
			echo "</tr>";
			while ($row = mysql_fetch_assoc($qry))
			{
				echo "<tr>";
				echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
				echo "<td>" . $row['user'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br>";
		} else
		{
			echo "Sorry, We don't have that name in our records </br>";
			echo "Try your full name or the other names you go by.</br>";
		}

		echo anchor('/auth', 'Back to Login');
	}

	/* This function processes the password forgot page.
	 * Sends an email to me, and the link to them
	 */
	function fpass()
	{
		$uname = $_POST['username'];
		$bfig = $this->config->item('bfig');

		if (isset($uname) && $uname != null && $uname != '' && $uname != " ")
		{
			if ($this->user_model->userExists($uname))
			{
				$uname = $_REQUEST['username'];
				$body = $uname . " Has just requested a password reset email.";
				if (!(mailer("blake@team2648.com", "Forgot Password", $body)))
					ui_set_error('There has been an error. Please try again later.(Error 7)');

				//Lets create a random number for security
				$rand = rand(0, 10000);
				$this->io->set($uname, $rand);

				$key = sha1(date("m.d.y") . $uname . $bfig['salt'] . $rand);
				//ui_set_message(date("m.d.y") . $uname . $bfig['salt'] . $rand);

				$body = "So you forgot your password.... \n\n"
						. "Click this link to reset your password\n\n"
						. site_url('/help/fvalidate/' . $key . '/' . $uname) . "\n\n"
						//. "http://www." . $sysurl . "/pages/forgot.php?key=" . $key . "&uname=" . $uname . "\n\n"
						. "If you recieved this email but did not request it, no action is required.";
				if (!(mailer($this->user_model->Uname2Email($uname), "Forgot Password", $body)))
				{ //@todo remove var?
					ui_set_error('There has been an error. Please try again later.(Error 8)');
					redirect('/help/forgot');
				}
			} else
			{
				ui_set_error('Invalid username, If this is in error Send an email to an administrator, include (Error 9)');
				redirect('/help/forgot');
			}
		} else
		{
			ui_set_error('You must enter your username');
			redirect('/help/forgot');
		}
		//Please check your email. The link will be valid until Midnight, EST @todo date
		ui_set_notice('Please check your email. The reset link will be valid until midnight.');
		redirect('/help/forgot');
	}

	/* The link the above function sent, links to this page.*/
	function fvalidate($key, $uname)
	{
		$uname = str_replace('_', '.', $uname);
		$dbrand = $this->io->get($uname);
		$bfig = $this->config->item('bfig');

		$dbkey = sha1(date("m.d.y") . $uname . $bfig['salt'] . $dbrand);

		if ($dbkey == $key)
		{
			$data['key'] = $key;
			$data['uname'] = $uname;
			$this->template->write_view('body','help/changepass.v.php', $data, true);
		$this->template->render();
			//$this->load->view('changepass.v.php', $data);
		} else
		{
			//echo "<br>invalid";
			ui_set_error('That Link is invalid');
			$this->io->remove($uname);
			redirect('/auth');
		}


	}

	function passchange()
	{
		$dbrand = $this->io->get($_POST['uname']);
		$bfig = $this->config->item('bfig');
		$dbkey = sha1(date("m.d.y") . $_POST['uname'] . $bfig['salt'] . $dbrand);
		if ($dbkey == $_POST['key'])
		{
			if ($_POST['passA'] == $_POST['passB'])
			{
				if (strlen($_POST['passA']) >= 6)
				{

					//change passwd
					if ($this->io->passwd(str_replace('_', '.', $_POST['uname']), $_POST['passA']))
					{
						//remove key from DB
						$this->io->remove($_POST['uname']);

						ui_set_message("Your password has been changed");
						redirect('/auth');
					} else
					{
						ui_set_error('There has been an error. Please contact an administrator. (Error code 6)');
						redirect('/auth');
					}
				}
				else
				{
					ui_set_error("Your password must be at least 6 characters long");
				redirect('/help/fvalidate/' . $dbkey . "/" . $_POST['uname']);
				}
			} else
			{
				//@todo Require a min length for the users password on reset
				ui_set_error("The passwords you entered do not match!");
				redirect('/help/fvalidate/' . $dbkey . "/" . $_POST['uname']);
			}
		} else
		{
			ui_set_error('Invalid Key');
			$this->io->remove($_POST['uname']);
			redirect('/auth');
		}
	}

}

//				//$uname = $_REQUEST['username'];
//				$body = $uname . " Has just requested a password reset email.";
//				if(mailer($bfig['captmail'], "Forgot Password", $body))
//						ui_set_message ('error');
//
//				$rand = rand(0, 10000);
//				$key = sha1(date("m.d.y") . $uname . $bfig['salt'] . $rand);
//
//				$this->io->set($uname, $rand);
//
//				$body = "So you forgot your password.... \n\n"
//						. "Click this link to reset your password\n\n"
//						. site_url('/help/fvalidate/' . $key . '/' . $uname) . "\n\n"
//						//. "http://www." . $sysurl . "/pages/forgot.php?key=" . $key . "&uname=" . $uname . "\n\n"
//						. "If you recieved this email but did not request it, no action is required.";
//
//
//
//				if(mailer($this->user_model->getEmail($uname), "Forgot Password", $body))
//				{
//					//@  todo remove var?
//					ui_set_error ('There was a problem sending you an email');
//					redirect('/help/forgot');
//				}
?>
