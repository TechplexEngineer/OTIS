<?php

class Profile extends Controller
{

	function __construct()
	{
		parent::Controller();
		$this->quickauth->restrict();
//		if (!$this->quickauth->is_logged_in())
//		{//The user is not logged in
//			redirect('auth/login/profile');
//		}
		$this->load->model('user_model', 'um');
	}

	function index()
	{
		$uid = $this->session->userdata('userid');

		//this tries to fix the undefined variable
		$row = $this->user_model->profile_get($uid);
		$fields = $this->user_model->getCols('profile');

		//this fill emptyies with ' ' a space character
		$row = blamkify($row, $fields);

		$this->template->write_view('nav', 'parts/nav.php', NULL, true);
		$this->template->write_view('body', 'e.profile.v.php', $row, true);
		$this->template->render();
	}

	function preview()
	{
		//Skip for now, just update
		$this->update();
	}

	function update()
	{ //Let's process this form!
		if ($this->um->profile_update($_POST))
		{
			ui_set_message('Your profile was successfully updated');
			redirect('/profile');
		} else
		{
			ui_set_error('There was a problem submitting your information');
			redirect('/profile');
		}
//            echo "Your profile was successfully updated<br>";
//            echo anchor('/', "Return to the dashboard");
//        } else
//        {
//            echo "There was a problem submitting your information";
//            exit;
//        }
		//$query = $this->db->query($sql);
		//send mail to moderators
		//#todo actually use the approved collumn when displaying profiles
//		echo "<link href=\"../css/styling.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
//		echo "<div class =\"widget\" style=\"width:350px\">";
//		echo "Your changes have been saved";
//		echo "<br>";
//		echo "<a href=\"../\">Click here to continue</a>";
//		echo "</div>";
	}

}

?>