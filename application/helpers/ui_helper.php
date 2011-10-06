<?php
function ui_set_message ($content)
{
	$ci =& get_instance();
	$ci->session->set_flashdata("UI-MSG", $content);
}

function ui_set_error ($content)
{
	$ci =& get_instance();
	$ci->session->set_flashdata("UI-ERR", $content);
}

function ui_set_notice ($content)
{
	$ci =& get_instance();
	$ci->session->set_flashdata("UI-NTC", $content);
}

// These only set data when debug error level is on.
function ui_debug_message($content)
{
	$ci =& get_instance();
	if($ci->config->item('debig_threshold') >=1)
		$ci->session->set_flashdata("UI-DEBUG-MSG", $content);
}
function ui_debug_error($content)
{
	$ci =& get_instance();
	if($ci->config->item('debig_threshold') >=1)
		$ci->session->set_flashdata("UI-DEBUG-ERR", $content);
}
//Notices are information about 
function ui_debug_notice($content)
{
	$ci =& get_instance();
	if($ci->config->item('debig_threshold') >=1)
		$ci->session->set_flashdata("UI-DEBUG-NTC", $content);
}

function ui_render ($clear=false)
{
	//$type = "UI-ALL"
	$ci =& get_instance();
	$message	= $ci->session->flashdata('UI-MSG');
	$error		= $ci->session->flashdata('UI-ERR');
	$notice		= $ci->session->flashdata('UI-NTC');
	//echo "<link rel='stylesheet' href='/application/media/css/ui.style.css' type='text/css' media='screen'/>";

	if($clear && (!empty($message) || !empty($error) || !empty($notice)))
	{
		echo '<div class="clear"></div>';
	}
	if (!empty($message))
	{

		echo '<center><div class="ui_alert message">'.$message.'</div></center>';
		//echo '<div class="clear"></div>';
		echo '<br/>';
	}
	if (!empty($error))
	{
		//echo '<div class="clear"></div>';
		echo '<center><div class="ui_alert error">'.$error.'</div></center>';
		//echo '<div class="clear"></div>';
		echo '<br/>';
	}
	if (!empty($notice))
	{
		//echo '<div class="clear"></div>';
		echo '<center><div class="ui_alert notice">'.$notice.'</div></center>';
		//echo'<div class="clear"></div>';
		echo '<br/>';
	}
	if($clear && (!empty($message) || !empty($error) || !empty($notice)))
	{
		echo '<div class="clear"></div>';
	}

//	if ($type == "UI-MSG" and !empty($message))
//	{
//		echo '<div class="clear"></div><center><div class="message">'.$message.'</div></center><div class="clear"></div>';
//	} elseif ($type == "UI-ERR" and !empty($error))
//	{
//		echo '<div class="clear"></div><center><div class="error">'.$error.'</div></center><div class="clear"></div>';
//	} elseif ($type == "UI-NTC" and !empty($notice))
//	{
//		echo '<div class="clear"></div><center><div class="notice">'.$notice.'</div></center><div class="clear"></div>';
//	} else
//	{
//		if (!empty($message))
//		{
//			echo '<div class="clear"></div><center><div class="message">'.$message.'</div></center><div class="clear"></div>';
//		} elseif (!empty($error))
//		{
//			echo '<div class="clear"></div><center><div class="error">'.$error.'</div></center><div class="clear"></div>';
//		} elseif (!empty($notice))
//		{
//			echo '<div class="clear"></div><center><div class="notice">'.$notice.'</div></center><div class="clear"></div>';
//		}
//	}
}

?>
