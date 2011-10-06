<?php

class Blog_model extends Model {

    function __construct() {
	parent::Model();
    }

    function getEntryArray($pid) {
	$bfig = $this->config->item('bfig');
	$sql = "SELECT * FROM " . $bfig['blog_table'] . " where id = '" . $pid . "'";
	$qry = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($qry);
	return $row;
    }

    function getTitle($pid) {
	$row = getEntryArray($pid);
	return $row['title'];
    }

    function getDate($pid) {
	$row = getEntryArray($pid);
	return $row['date'];
    }

    function getEntry($pid) {
	$row = getEntryArray($pid);
	return $row['post'];
    }

    function getAuthor($pid) {
	$row = getEntryArray($pid);
	return $row['author'];
    }

    function getState($pid) {
	$row = getEntryArray($pid);
	return $row['approved'];
    }

    function approve($bid) {
	$bfig = $this->config->item('bfig');
	$sql = "UPDATE " . $bfig['blog_table'] . " SET approved='1' WHERE id='" . $bid . "'";
	$qry = $this->db->query($sql);
	if (mysql_error ()) {
	    ui_set_error('We were unable to approve the entry. (Error 10)[blog_model:approve]');
	    ui_debug_error($sql);
	    return false;
	}
	return true;
    }

    function unapprove($bid) {
	$bfig = $this->config->item('bfig');
	$sql = "UPDATE " . $bfig['blog_table'] . " SET approved='0' WHERE id='" . $bid . "'";
	$qry = $this->db->query($sql);
	if (mysql_error ()) {
	    ui_set_error('We were unable to approve the entry. (Error 10)[blog_model:unapprove]');
	    ui_debug_error($sql);
	    return false;
	}
	return true;
    }

    function update($data) {
	$bfig = $this->config->item('bfig');

	$date = mysql_real_escape_string($data['date']);
	$time = strtotime($date);
	$mdate = date('y-m-d', $time);

	$sql = "UPDATE " . $bfig['blog_table'] . " SET
			title =		'" . mysql_real_escape_string($data['title']) . "',
			date =		'" . $date . "',
			mdate =		'" . $mdate . "',
			post =		'" . mysql_real_escape_string($data['post']) . "',
			author =	'" . mysql_real_escape_string($data['author']) . "'
			    WHERE id='" . $data['id'] . "'";
	//lastUpdate =	 CURDATE(),
	//echo $sql . "<br>";
	$qry = $this->db->query($sql);
	if (mysql_error ()) {
	    ui_set_error('We were unable to update the blog entry. (Error 10) [blog_model:update]');
	    ui_debug_error($sql);
	    return false;
	}
	return true;
    }

    function getPendingEntries()
    {
	$bfig = $this->config->item('bfig');
	$sql = "SELECT * FROM " . $bfig['blog_table'] . " where id = '" . $pid . "'";
	$qry = mysql_query($sql) or die(mysql_error());
	return  mysql_num_rows($qry);
    }
    function getTotalEntries()
    {
	$bfig = $this->config->item('bfig');
	$sql = "SELECT * FROM " . $bfig['blog_table'] . " where approved = 'false'";
	$qry = mysql_query($sql) or die(mysql_error());
	return  mysql_num_rows($qry);
    }

}

?>
