<?php

class Data_status_model extends Model
{

    var $profile_table = "profile";
    var $account_table = "account";
    var $econtact_table = "econtact";

    function __construct()
    {
        parent::Model();
		show_error("this file has been depreciated");
    }

    /*
	 * Given ID what is the state of user's profile
    */

    function web_state($id)
    {

        $sql = "SELECT * FROM `" . $this->profile_table . "` WHERE id ='" . $id . "'";
        $qry = mysql_query($sql) or die(mysql_error());

        $row = mysql_fetch_assoc($qry);
        if (is_array($row))
        {
            if ($row['approved'] == 1)
                return "approved";

            foreach ($row as $key => $val)
            {
                if (($val == '' || $val == ' ')&& $key != 'bio')
                    return "incomplete";
                //echo "value".$val . "\n";
            }
            return "pending";
        }
        else
            return "incomplete";
            //return "not started";
        //return "error";



//		$sql = "SELECT * FROM `" . $this->profile_table . "` WHERE id ='" . $id . "'";
//		$qry = mysql_query($sql) or die(mysql_error());
//		if (mysql_num_rows($qry) > 0)
//		{
//			$row = mysql_fetch_assoc($qry);
//			if ($row['approved'] == 1)
//				return "approved";
//			else
//				return "pending";
//		}
//		else
//			return "incomplete";
    }

    function account_complete($id)
    {

        $sql = "SELECT * FROM `" . $this->account_table . "` WHERE id ='" . $id . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row2 = mysql_fetch_assoc($qry);

        $profileIncomplete = false;
        if ($row2['homephone'] == "" || $row2['homephone'] == " ")
            $profileIncomplete = true;
        if ($row2['cellphone'] == "" || $row2['cellphone'] == " ")
            $profileIncomplete = true;
        if ($row2['medications'] == "" || $row2['medications'] == " ")
            $profileIncomplete = true;
        if ($row2['mailaddress'] == "" || $row2['mailaddress'] == " ")
            $profileIncomplete = true;
        return!$profileIncomplete;
    }

    function econtact_complete($id)
    {

        $sql = "SELECT * FROM `" . $this->econtact_table . "` WHERE id ='" . $id . "'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row3 = mysql_fetch_assoc($qry);

        $econtactIncomplete = false;
        if ($row3['ec1_fullname'] == "" || $row3['ec1_fullname'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_email'] == "" || $row3['ec1_email'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_mailingaddress'] == "" || $row3['ec1_mailingaddress'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_homephone'] == "" || $row3['ec1_homephone'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_workphone'] == "" || $row3['ec1_workphone'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_cellphone'] == "" || $row3['ec1_cellphone'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_relation'] == "" || $row3['ec1_relation'] == " ")
            $econtactIncomplete = true;
        if ($row3['ec1_bestway'] == "" || $row3['ec1_bestway'] == " ")
            $econtactIncomplete = true;

        return!$econtactIncomplete;
    }

//web_state($id)
//info_complete($id)
//econtact_complete($id)
}

?>
