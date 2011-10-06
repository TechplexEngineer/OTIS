<?php

class Blog_model extends Model {

    function __construct() {
	parent::Model();
    }

    function insertorupdate($data) {
	$bfig = $this->config->item('bfig');

	//id, type, body, start, end, completed

	$sql = "INSERT INTO " . $bfig['announce_table']
		   . "(`id`, `type`, `body`, `start`, `end`, `completed`)"
		   . "VALUES (
		'" . mysql_real_escape_string($data['id'])	. "',
		'" . mysql_real_escape_string($data['type'])	. "',
		'" . mysql_real_escape_string($data['body'])	. "',
		'" . mysql_real_escape_string($data['start'])	. "',
		'" . mysql_real_escape_string($data['end'])	. "',
		'" . mysql_real_escape_string($data['completed']) ."'	"
		   . "ON DUPLICATE KEY UPDATE " . $bfig['announce_table'] . " SET
			type =		'" . mysql_real_escape_string($data['type']) . "',
			body =		'" . mysql_real_escape_string($data['body']) . "',
			start =		'" . mysql_real_escape_string($data['start']) . "',
			end =		'" . mysql_real_escape_string($data['end']) . "',
			completed =	'" . mysql_real_escape_string($data['completed']) . "'
			WHERE id=	'" . mysql_real_escape_string($data['id']) . "'	";
	
	$qry = mysql_query($sql);
	if (mysql_error ()) {
	    echo mysql_error();
	    return false;
	}
	return true;  //Success
    }
}

?>
