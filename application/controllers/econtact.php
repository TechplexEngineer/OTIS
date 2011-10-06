<?php

class econtact extends Controller
{

	function __construct()
	{
		parent::Controller();
		$this->quickauth->restrict();
//		if (!$this->quickauth->is_logged_in())
//		{//The user is not logged in
//			redirect('auth/login/econtact');
//		}
		$this->load->model('user_model', 'um');
	}

	function index()
	{
		$uid = $this->session->userdata('userid');

		//this tries to fix the undefined variable
		$row = $row = $this->um->econtact_get($uid);
		$fields = $this->user_model->getCols('econtact');

		//this fill emptyies with ' ' a space character
		$row = blamkify($row, $fields);

		$this->template->write_view('nav', 'parts/nav.php', NULL, true);
		$this->template->write_view('body', 'e.econtact.v.php', $row, true);
		$this->template->render();
	}

	function update()
	{
		if ($this->um->econtact_update($_POST))
		{
			ui_set_message( "Your profile was successfully updated");
			redirect('/econtact');
		} else
		{
			ui_set_error("There was a problem submitting your information");
			redirect('/econtact');
		}
		
	}

}

?>
