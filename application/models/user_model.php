<?php

class User_model extends Model {

    function __construct() {
        parent::Model();
    }

    //This model stands to represent all the operations one would need to do to a user's data.
    //Should it be an object which represnets a single user

    function ID2FullName($uid, $separator = " | ") {
        $bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM " . $bfig['login_table'] . " where id = '" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['firstname'] . $separator . $row['lastname'];
    }

    function ID2FirstName($uid) {
        $bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM " . $bfig['login_table'] . " where id = '" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['firstname'];
    }

    function ID2Lastname($uid) {
        $bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM " . $bfig['login_table'] . " where id = '" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['lastname'];
    }

    function UName2ID($uname) {
        $bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM " . $bfig['login_table'] . " where user = '" . $uname . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['id'];
    }

    function UName2Email($uname) {
        $bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM " . $bfig['login_table'] . " where user = '" . $uname . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['email'];
    }

    function ID2yog($uid) {
        $bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM " . $bfig['profile_table'] . " where id = '" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);

        return $row['yog'];
    }

    function ID2Grade($uid) {
        $yog = $this->ID2yog($uid);
        $this->YOG2Grade($yog);
    }

    function YOG2Grade($yog) {
        $year = date('Y');
        $month = date('m');

        if ($month < 6) {
            if ($yog - $year == 0)
                return "Senior";
            elseif ($yog - $year == 1)
                return "Junior";
            elseif ($yog - $year == 2)
                return "Sophomore";
            elseif ($yog - $year == 3)
                return "Freshman";
            else
                return "ERROR";
        }else {
            if ($yog - $year == 0)
                return "Alumni";
            elseif ($yog - $year == 1)
                return "Senior";
            elseif ($yog - $year == 2)
                return "Junior";
            elseif ($yog - $year == 3)
                return "Sophomore";
            elseif ($yog - $year == 4)
                return "Freshman";
            else
                return "ERROR";
        }
    }

    function UserExists($iden) {
        if (is_string($iden)) {
            $bfig = $this->config->item('bfig');
            $sql = "SELECT * FROM " . $bfig['login_table'] . " where user = '" . $iden . "'";
        }
        if (is_integer($iden)) {
            $bfig = $this->config->item('bfig');
            $sql = "SELECT * FROM " . $bfig['login_table'] . " where id = '" . $iden . "'";
        }
        $qry = mysql_query($sql) or die(mysql_error());
        if (mysql_num_rows($qry) >= 1)
            return true;
        return false;
    }

    var $profile_table = "profile";
    var $account_table = "account";
    var $econtact_table = "econtact";

    /*
     * @return incomplete, pending, approved
     * @todo yog, role, plans
     */

    function web_state($uid) {

        $sql = "SELECT * FROM `" . $this->profile_table . "` WHERE id ='" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());

        $row = mysql_fetch_assoc($qry);
        if (is_array($row)) {
            if ($row['approved'] == 1)
                return "approved";

            foreach ($row as $key => $val) {
                if (($val == '' || $val == ' ') && $key != 'bio')
                    return "incomplete";
            }
            return "pending";
        }
        else {
            ui_debug_notice('An array was not returned. See the User Model. [Web]');
            return "incomplete";
        }
    }

    /*
     * @return true, false
     */

    function account_complete($uid) {
        $sql = "SELECT * FROM `" . $this->account_table . "` WHERE id ='" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());

        $row = mysql_fetch_assoc($qry);
        if (is_array($row)) {
            foreach ($row as $key => $val) {
                if ($val == '' || $val == ' ')
                    return false;
            }
            return true;
        }
        else {
            ui_debug_notice('An array was not returned. See the User Model. [Account]');
            return false;
        }

//		$profileIncomplete = false;
//		if ($row2['homephone'] == "" || $row2['homephone'] == " ")
//			$profileIncomplete = true;
//		if ($row2['cellphone'] == "" || $row2['cellphone'] == " ")
//			$profileIncomplete = true;
//		if ($row2['medications'] == "" || $row2['medications'] == " ")
//			$profileIncomplete = true;
//		if ($row2['mailaddress'] == "" || $row2['mailaddress'] == " ")
//			$profileIncomplete = true;
//		return!$profileIncomplete;
    }

    /*
     * @return true, false
     */

    function econtact_complete($uid) {

        $sql = "SELECT * FROM `" . $this->econtact_table . "` WHERE id ='" . $uid . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        //$row3 = mysql_fetch_assoc($qry);

        $row = mysql_fetch_assoc($qry);
        if (is_array($row)) {
            foreach ($row as $key => $val) {
                if ($val == '' || $val == ' ')
                    return false;
            }
            return true;
        }
        else {
            //ui_debug_notice('An array was not returned. See the User Model. [EContact]');
            return "ERROR";
        }
    }

//		$econtactIncomplete = false;
//		if ($row3['fullname'] == "" || $row3['fullname'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['email'] == "" || $row3['email'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['mailingaddress'] == "" || $row3['mailingaddress'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['homephone'] == "" || $row3['homephone'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['workphone'] == "" || $row3['workphone'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['cellphone'] == "" || $row3['cellphone'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['relation'] == "" || $row3['relation'] == " ")
//			$econtactIncomplete = true;
//		if ($row3['bestway'] == "" || $row3['bestway'] == " ")
//			$econtactIncomplete = true;
//
//		return!$econtactIncomplete;

    function getTeam() {
        $sql = "SELECT * FROM `profile` ORDER BY yog, id"; //where approved
        $qry = mysql_query($sql) or die(mysql_error());

        while ($row = mysql_fetch_assoc($qry)) {
            $out[] = $row;
        }
        return $out;
    }

    function getCols($table) {
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $table . "' AND TABLE_SCHEMA = 'OIS'";
        $qry = mysql_query($sql) or die(mysql_error());
        //echo $qry;

        while ($row = mysql_fetch_assoc($qry))
            $col[] = $row['COLUMN_NAME'];

        return $col;
    }

    //==============================================================================
// Profile \\

    function profile_get($uid) {
        $query = $this->db->query('SELECT firstname FROM users WHERE id=' . $uid);
        $rowa = $query->result_array();

        $query = $this->db->query('SELECT * FROM profile WHERE id=' . $uid);
        $rowb = $query->result_array();

        $row = mergeDBqry($rowa, $rowb);
        if (!is_array($row)) {
            $row = array();
            $row['nickname'] = "nothere";
        }
        return $row;

//return mergeDBqry($rowa, $rowb);
    }

    function profile_update($data) {
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
        if (mysql_error ()) {
            echo mysql_error();
            return false;
        }
        return true;  //Success
    }

//==============================================================================
// Account \\

    function account_get($uid) {
//@todo users & profile -> var
        $query = $this->db->query('SELECT firstname, lastname, email FROM users WHERE id=' . $uid);
        $rowa = $query->result_array();

        $query = $this->db->query('SELECT * FROM account WHERE id=' . $uid);
        $rowb = $query->result_array();

        $row = mergeDBqry($rowa, $rowb);
        if (!is_array($row)) {
            $row = array();
            $row['homephone'] = "[NONE]";
        }
        return $row;
//return ;
    }

    function account_update($data) {
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

        if (mysql_error ()) {
            ui_set_error('We were unable to update the account. (Error 10) [user_model:account_update]');
            ui_debug_error($sql);
            return false;
        }
        return true;
    }

//==============================================================================
// EContact \\

    function econtact_update($data) {
//@todo econtact -> var
        $sql = "INSERT INTO `econtact`"
                . "(`id`, `fullname`, `email`, `mailingaddress`, `homephone`, `workphone`, `cellphone`, `relation`, `bestway`) \n"
                . "VALUES (
                    '" . mysql_real_escape_string($data['id']) . "',
                    '" . mysql_real_escape_string($data['fullname']) . "',
                    '" . mysql_real_escape_string($data['email']) . "',
                    '" . mysql_real_escape_string($data['mailingaddress']) . "',
                    '" . mysql_real_escape_string($data['homephone']) . "',
                    '" . mysql_real_escape_string($data['workphone']) . "',
                    '" . mysql_real_escape_string($data['cellphone']) . "',
                    '" . mysql_real_escape_string($data['relation']) . "',
                    '" . mysql_real_escape_string($data['bestway']) . "')\n"
                . "ON DUPLICATE KEY UPDATE "
                . "   fullname ='" . mysql_real_escape_string($data['fullname'])
                . "', email='" . mysql_real_escape_string($data['email'])
                . "', mailingaddress= '" . mysql_real_escape_string($data['mailingaddress'])
                . "', homephone='" . mysql_real_escape_string($data['homephone'])
                . "', workphone='" . mysql_real_escape_string($data['workphone'])
                . "', cellphone='" . mysql_real_escape_string($data['cellphone'])
                . "', relation='" . mysql_real_escape_string($data['relation'])
                . "', bestway='" . mysql_real_escape_string($data['bestway'])
                . "'\n";
        $qry = mysql_query($sql);

        if (mysql_error ()) {
//echo mysql_error();
            return false;
        }
        return true;
    }

    function econtact_get($uid) {
        $query = $this->db->query('SELECT * FROM econtact WHERE id=' . $uid);
        $row = mergeDBqry($query->result_array());
        if (!is_array($row)) {
            $row = array();
            $row['name'] = "[NONE]";
        }
        return $row;
    }

//==============================================================================

    function allUsers() {
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

    function lastlogin($user) {
        $sql = "UPDATE users SET last_login='" . date("m.d.y h:i:s A") . "' WHERE user='" . $user . "'";
        $qry = $this->db->query($sql);
        if (mysql_error ()) {
            ui_set_error('Something really bad went wrong. please contact an administrator. (Error 10)[' . $user . ']');
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
