<?php

class Vocab_model extends Model{
    function  __construct() {
	parent::Model();
    }

    function getList(){

	$bfig = $this->config->item('bfig');
	$sql = "SELECT * FROM " . $bfig['vocab_table'];
	$qry = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($qry);
	return $row;
    }
    function get($word)
    {
	$bfig = $this->config->item('bfig');
	$sql = "SELECT * FROM " . $bfig['vocab_table'] . " WHERE word = '" . $word . "'";
	//echo $sql;
	$qry = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($qry);
	return $row;
    }

    function addorupdate($data)
    {
	$bfig = $this->config->item('bfig');
	$sql = "INSERT INTO `".$bfig['vocab_table']."` "
		. "(`word`, `def`) \n"
		. "VALUES (
                    '" . mysql_real_escape_string($data['word']) . "',
                    '" . mysql_real_escape_string($data['def']) . "')\n"
		. "ON DUPLICATE KEY UPDATE
                    word='" . mysql_real_escape_string($data['word']) . "',
                    def='" . mysql_real_escape_string($data['def']) . "'\n";
	$qry = mysql_query($sql);


	if (mysql_error ()) {
	    ui_set_error('We were unable to update the definition (Error 10) [vocab_model:addorupdate]');
	    ui_set_notice(mysql_error ());
	    ui_set_message($sql);
	    return false;
	}
	return true;
    }


}

?>
