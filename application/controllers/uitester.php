<?php

class Uitester extends Controller
{

	function index($page='/uitester/show')
	{
		ui_set_error('error');
		ui_set_message("Your message has been posted to the team facebook wall<br>" . anchor('http://www.facebook.com/pages/Oakland-ME/Team-2648/146072532332', "See the Post here", array('target' => '_blank')) . "<br>" . anchor('/', "Return to the dashboard"));
			
		//ui_set_message('message');
		ui_set_notice('notice ');

		redirect($page);
		//If the function spesified in the url doesn't exist, send it bak to index, as a paramenter.
	}
	function page($page='/uitester/show')
	{
		//ui_set_error('error');
		ui_set_message('Your Password has successfully been reset');
		//ui_set_notice('notice ');

		redirect($page);
	}
	function show()
	{
		ui_render();
	}

}

?>
