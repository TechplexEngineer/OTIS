<?php

class User_info_model extends Model
{

	function __construct()
	{
		parent::Model();
		show_error("this file has been depreciated");
	}

//==============================================================================
// Profile \\

	function profile_get($uid)
	{
		$query = $this->db->query('SELECT firstname FROM users WHERE id=' . $uid);
		$rowa = $query->result_array();

		$query = $this->db->query('SELECT * FROM profile WHERE id=' . $uid);
		$rowb = $query->result_array();

		$row = mergeDBqry($rowa, $rowb);
		if (!is_array($row))
		{
			$row = array();
			$row['nickname'] = "nothere";
		}
		return $row;

//return mergeDBqry($rowa, $rowb);
	}

	function profile_update($data)
	{
//@todo profile -> var
		$sql = "INSERT INTO `profile`"
				. "(`id`, `nickname`, `location`, `role`, `yog`, `interests`, `favMoment`, `gainThisYr`, `futurePlans`, `bio`) \n"
				. "VALUES ( '" . mysql_real_escape_string($data['id']) . "',
							'" . mysql_real_escape_string($data['nickname']) . "',
							'" . mysql_real_escape_string($data['town']) . "',
							'" . mysql_real_escape_string($data['role']) . "',
							'" . mysql_real_escape_string($data['yog']) . "',
							'" . mysql_real_escape_string($data['interests']) . "',
							'" . mysql_real_escape_string($data['fav_moment']) . "',
							'" . mysql_real_escape_string($data['gain']) . "',
							'" . mysql_real_escape_string($data['future']) . "',
							'" . mysql_real_escape_string($data['bio']) . "')\n"
				. "ON DUPLICATE KEY UPDATE nickname ='" . mysql_real_escape_string($data['nickname']) . "',
					location='" . mysql_real_escape_string($data['town']) . "',
					role= '" . mysql_real_escape_string($data['role']) . "',
					yog='" . mysql_real_escape_string($data['yog']) . "',
					interests='" . mysql_real_escape_string($data['interests']) . "',
					favMoment='" . mysql_real_escape_string($data['fav_moment']) . "',
					gainThisYr='" . mysql_real_escape_string($data['gain']) . "',
					futurePlans='" . mysql_real_escape_string($data['future']) . "',
					bio='" . mysql_real_escape_string($data['bio']) . "'\n";
		$qry = mysql_query($sql);
		if (mysql_error ())
		{
			echo mysql_error();
			return false;
		}
		return true;  //Success
	}

//==============================================================================
// Account \\

	function account_get($uid)
	{
//@todo users & profile -> var
		$query = $this->db->query('SELECT firstname, lastname, email FROM users WHERE id=' . $uid);
		$rowa = $query->result_array();

		$query = $this->db->query('SELECT * FROM account WHERE id=' . $uid);
		$rowb = $query->result_array();

		$row = mergeDBqry($rowa, $rowb);
		if (!is_array($row))
		{
			$row = array();
			$row['homephone'] = "[NONE]";
		}
		return $row;
//return ;
	}

	function account_update($data)
	{
//@todo account -> var
		$sql = "INSERT INTO `account`"
				. "(`id`, `homephone`, `cellphone`, `medications`, `mailaddress`) \n"
				. "VALUES (
                    '" . mysql_real_escape_string($data['id']) . "',
                    '" . mysql_real_escape_string($data['homephone']) . "',
                    '" . mysql_real_escape_string($data['cellphone']) . "',
                    '" . mysql_real_escape_string($data['medications']) . "',
                    '" . mysql_real_escape_string($data['mailaddress']) . "')\n"
				. "ON DUPLICATE KEY UPDATE
                    homephone ='" . mysql_real_escape_string($data['homephone']) . "',
                    cellphone='" . mysql_real_escape_string($data['cellphone']) . "',
                    medications= '" . mysql_real_escape_string($data['medications']) . "',
                    mailaddress='" . mysql_real_escape_string($data['mailaddress']) . "'\n";
		$qry = mysql_query($sql);

//SQL 4 email
		$sql = "UPDATE `users` SET email = '" . mysql_real_escape_string($data['email']) . "' WHERE id = " . $data['id'];
		$qry = mysql_query($sql) or die(mysql_error());

		if (mysql_error ())
		{
			echo mysql_error();
			return false;
		}
		return true;
	}

//==============================================================================
// EContact \\

	function econtact_update($data)
	{
//@todo econtact -> var
		$sql = "INSERT INTO `econtact`"
				. "(`id`, `ec1_fullname`, `ec1_email`, `ec1_mailingaddress`, `ec1_homephone`, `ec1_workphone`, `ec1_cellphone`, `ec1_relation`, `ec1_bestway`) \n"
				. "VALUES (
                    '" . mysql_real_escape_string($data['id']) . "',
                    '" . mysql_real_escape_string($data['ec1_fullname']) . "',
                    '" . mysql_real_escape_string($data['ec1_email']) . "',
                    '" . mysql_real_escape_string($data['ec1_mailingaddress']) . "',
                    '" . mysql_real_escape_string($data['ec1_homephone']) . "',
                    '" . mysql_real_escape_string($data['ec1_workphone']) . "',
                    '" . mysql_real_escape_string($data['ec1_cellphone']) . "',
                    '" . mysql_real_escape_string($data['ec1_relation']) . "',
                    '" . mysql_real_escape_string($data['ec1_bestway']) . "')\n"
				. "ON DUPLICATE KEY UPDATE "
				. "   ec1_fullname ='" . mysql_real_escape_string($data['ec1_fullname'])
				. "', ec1_email='" . mysql_real_escape_string($data['ec1_email'])
				. "', ec1_mailingaddress= '" . mysql_real_escape_string($data['ec1_mailingaddress'])
				. "', ec1_homephone='" . mysql_real_escape_string($data['ec1_homephone'])
				. "', ec1_workphone='" . mysql_real_escape_string($data['ec1_workphone'])
				. "', ec1_cellphone='" . mysql_real_escape_string($data['ec1_cellphone'])
				. "', ec1_relation='" . mysql_real_escape_string($data['ec1_relation'])
				. "', ec1_bestway='" . mysql_real_escape_string($data['ec1_bestway'])
				. "'\n";
		$qry = mysql_query($sql);

		if (mysql_error ())
		{
//echo mysql_error();
			return false;
		}
		return true;
	}

	function econtact_get($uid)
	{
		$query = $this->db->query('SELECT * FROM econtact WHERE id=' . $uid);
		$row = mergeDBqry($query->result_array());
		if (!is_array($row))
		{
			$row = array();
			$row['ec1_name'] = "[NONE]";
		}
		return $row;
	}

//==============================================================================

	function allUsers()
	{
		$login_table = "users";
		$account_table = "account";
		$sql = "SELECT " . $login_table . ".*, " . $account_table . ".homephone, " . $account_table . ".cellphone, " . $account_table . ".medications, " . $account_table . ".mailaddress FROM " . $login_table . " LEFT OUTER JOIN " . $account_table . "
			ON " . $login_table . ".id = " . $account_table . ".id
			ORDER BY firstname, lastname ASC";
		$qry = $this->db->query($sql);

//echo print_r($qry->result());

		return $qry->result();
	}

//==============================================================================

	function lastlogin($user)
	{
		$sql = "UPDATE users SET last_login='" . date("m.d.y") . "' WHERE user='" . $user . "'";
		$qry = $this->db->query($sql);
		if(mysql_error())
		{
			ui_set_error('Something really bad went wrong. please contact an administrator. (Error 10)['.$user.']');
			ui_debug_error($sql);
		}
//		if (mysql_error ())
//		{
//			echo "llerror".mysql_error();
//			return false;
//		}
//		return true;
	}

//$qry = mysql_query($sql) or die(mysql_error ());
//		if (mysql_error ())
//		{
//			return false;
//		}
//return $qry->row_array();
}

?>
