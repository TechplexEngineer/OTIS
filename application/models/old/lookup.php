<?php
class Lookup extends Model
{
    
    function __Construct()
    {
        parent::Model();
		//$data;
        //$bfig = $data;
		//$bfig['login_table']='users';
		//$bfig = $this->config->item('bfig');
		show_error("this file has been depreciated");
    }

    function lookUpName($id) //ID 2 NAME
    {
		$bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM ".$bfig['login_table']." where id = '". $id ."'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['firstname'] . " | " . $row['lastname'];
    }
    function getFirstName($id)
    {
		$bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM ".$bfig['login_table']." where id = '". $id ."'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['firstname'];
    }
    function getLastName($id)
    {
		$bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM ".$bfig['login_table']." where id = '". $id ."'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['lastname'];
    }

    function getID($uname)
    {
		$bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM ".$bfig['login_table']." where user = '". $uname ."'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['id'];
    }
    function getEmail($uname)
    {
		$bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM ".$bfig['login_table']." where user = '". $uname ."'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['email'];
    }
    function userExists($uname)
    {
		$bfig = $this->config->item('bfig');
        $sql = "SELECT * FROM ".$bfig['login_table']." where user = '". $uname ."'";
		//echo $sql;
        $qry = mysql_query($sql) or die(mysql_error());
        if(mysql_num_rows($qry)  >= 1)
            return true;
        return false;


    }


//ID2MAIL
//ID2HOURS
//
}

?>