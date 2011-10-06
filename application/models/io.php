<?php

class Io extends Model
{

    function __Construct()
    {
        parent::Model();
    }

    /**
     *
     * @param <string> $name
     * @return <string> corresponding db value
     */
    function get($name)
    {
        $sql = "SELECT * FROM vars WHERE name='" . $name."'";
        $qry = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($qry);
        return $row['value'];
    }

    /**
     *
     * @param <type> $name
     * @param <type> $value
     */
    function set($name, $value)
    {
	$value = mysql_real_escape_string($value);
	$name = mysql_real_escape_string($name);

        $sql = "INSERT INTO `vars` (`name`, `value`) VALUES ('" . $name . "', '" . $value . "')"
                . "ON DUPLICATE KEY UPDATE `value` ='" . $value."'";
	//echo $sql;
        //echo $sql;
        mysql_query($sql) or die(mysql_error());
    }

    /**
     *
     * @param <string> $name
     * @return <boolean> true / false based on mysql error
     *
     */
    function remove($name)
    {
        $sql="DELETE FROM vars WHERE name='".mysql_real_escape_string($name)."'";
        mysql_query($sql);
        if(mysql_error())
        {
	    ui_set_notice(mysql_error()."<br>".$sql);
            return false;
        }
        return true;
    }

    /**
     * This doesn't appear to be used.
     * @param <string> $user
     * @param <string> $paswd
     * @return <boolean> true / false based on mysql error
     */
    function passwd($user, $paswd)
    {
        $sql = "UPDATE users SET pass='".sha1($paswd)."' WHERE user='".mysql_real_escape_string($user)."'";
        mysql_query($sql);

        if(mysql_error())
        {
	    ui_set_notice(mysql_error()."<br>".$sql);
            return false;
        }
        return true;
    }

}

?>
