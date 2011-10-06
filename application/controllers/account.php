<?php

class account extends Controller
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
		$row = $row = $this->um->account_get($uid);
		$fields = $this->user_model->getCols('account');

		//this fill emptyies with ' ' a space character
		$row = blamkify($row, $fields);

		$this->template->write_view('nav', 'parts/nav.php', NULL, true);
		$this->template->write_view('body', 'e.account.v.php', $row, true);
		$this->template->render();
	}

	function update()
	{
		if ($this->um->account_update($_POST))
		{
			ui_set_message( "Your information was successfully updated");
			redirect('account');
			//echo anchor('/', "Return to the dashboard");
		} else
		{
			ui_set_error( "There was a problem submitting your information");
			redirect('account');
			//exit;
		}
	}

}

?>
