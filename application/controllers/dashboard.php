<?php

class Dashboard extends Controller
{

	function __construct()
	{
		parent::Controller();
		$this->quickauth->restrict(); // @todo the restrict policy doesn't have support for log into a certian page
//		if (!$this->quickauth->is_logged_in())
//		{//The user is not logged in
//			//ui_set_message("You have been logged out.");
//			redirect('auth/login/dashboard');
//		}
	}

	function index()
	{
	    //ui_render();
		$this->load->model('user_model', 'um');

		$nagboxHTML = "<ul style=\"padding-left: 10px;\">\n";

		$uid = $this->session->userdata('userid');
		if ($this->um->web_state($uid) == 'pending')
			$nagboxHTML .= "<li>Profile awaiting moderation.</li>\n";
		else if ($this->um->web_state($uid) == 'approved')
			$nagboxHTML .= "<li>Your Profile has been approved!</li>\n";
		else if ($this->um->web_state($uid) == 'incomplete')
			$nagboxHTML .= "<li>Your Profile is incomplete ".anchor('/profile', "finish here")."</li>";

		if (!$this->um->account_complete($uid))
			$nagboxHTML .= "<li>You are missing critical information <a href=\"/account\">fix here</a></li>";

		if (!$this->um->econtact_complete($uid))
			$nagboxHTML .= "<li>Your emergency contact is incomplete <a href=\"/econtact\">fill it in here</a></li>";

		$nagboxHTML .= "</ul>";
		$data['nagbox'] = $nagboxHTML;


		$this->template->write_view('nav', 'parts/nav.php', NULL, true);
		$this->template->write_view('body', 'dashboard.v.php', $data, TRUE);
		$this->template->render();
	}

}

?>
