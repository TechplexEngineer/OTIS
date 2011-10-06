<?php

class data extends Controller
{

	function index()
	{
		show_404();
	}

	function sms()
	{
		$this->load->model('contacts');

		$smsaddy = $this->contacts->sms();

		foreach ($smsaddy as $key => $value)
		{
			echo $value;
		}
		echo "All Team Members";
	}

	function teamMembers($member='all')
	{
//		if ($member == 'all')
//		{
//			//sort the users into their respectivve arrays
////			$sql = "SELECT * FROM `profile` ORDER BY yog, id"; //where approved
////			$qry = mysql_query($sql) or die(mysql_error());
//
//			$rows; // will contain all the users
//			$seniors = array();
//			$juniors = array();
//			$sophomores = array();
//			$freshmen = array();
//
//			$alumni = array();
//			$this->load->model('user_model', 'um');
//			$team = $this->um->getTeam();
//			foreach ($team as $row)
//			{
//				//@todo there is probably a better way to do this
//
//				$row['name'] = $this->um->ID2FirstName($row['id']);
//				$rows[] = $row;
//
//				switch ($this->um->YOG2Grade($row['yog']))
//				{
//					case "Senior":
//						$seniors[] = $row;
//						break;
//					case "Junior":
//						$juniors[] = $row;
//						break;
//					case "Sophomore":
//						$sophomores[] = $row;
//						break;
//					case "Freshman":
//						$freshmen[] = $row;
//						break;
//					case "ERROR":
//						break;
//					default:
//						$alumni[] = $row;
//						break;
//				}
//			}
//
//			function cmp($a, $b)
//			{
//				return strcmp(strtolower($a['name']), strtolower($b['name']));
//			}
//
//			usort($seniors, "cmp");
//			usort($juniors, "cmp");
//			usort($sophomores, "cmp");
//			usort($freshmen, "cmp");
//			usort($alumni, "cmp");
//
//			$data['seniors'] = $seniors;
//			$data['juniors'] = $juniors;
//			$data['sophomores'] = $sophomores;
//			$data['freshmen'] = $freshmen;
//			$data['alumni'] = $alumni;
//
//			$this->load->view('out/team_members.d.php', $data);
//		}
	}

	function test()
	{
		if (@fclose(@fopen("http://www.team2648.com/2011/people/kristen.jpg", "r")))
			echo "image exists";
		else
			echo "image does not exist";

//			if (file_exists('http://www.team2648.com/2011/people/kristen.jpg'))
//				echo "true";
//			else
//				echo "false";
	}

}

?>
