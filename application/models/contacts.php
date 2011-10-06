<?php

class Contacts extends Model
{
	function  __construct()
	{
		parent::Model();
	}

	function sms()
	{
		$login_table = 'users';
		$sql = "SELECT firstname, lastname, sms FROM ".$login_table." WHERE sms ORDER BY firstname, lastname DESC";
		$qry = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_assoc($qry))
		{
			$sms[] = $row['firstname'] . " " . $row['lastname'] . " <" . $row['sms'] . ">/ ";
		}
		return $sms;
	}

	function email()
	{
		$login_table = 'users';
		$sql = "SELECT * FROM ".$login_table." ORDER BY firstname, lastname DESC";
		$qry = mysql_query($sql) or die(mysql_error());


		while ($row = mysql_fetch_assoc($qry))
		{
			$emails[] = $row['firstname'] . " " . $row['lastname'] . " <" . $row['email'] . ">/ ";
		}

		$sql = "SELECT * FROM MailingListMember ORDER BY firstname, lastname DESC";
		//echo $sql;
		$qry = mysql_query($sql) or die(mysql_error());

		while ($row = mysql_fetch_assoc($qry))
		{
			$emails[] = $row['name'] . " <" . $row['email'] . ">/";
		}

		return $emails;
	}

}


?>

