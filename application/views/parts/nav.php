
<?php

/*
  | This file is responisble for generatin the navigaion pane
  |
 */

echo "<ul>";

$bfig = $this->config->item('bfig');

//$this->CI =& get_instance();
$sdata = $this->session->all_userdata();
if (!empty($sdata['username'])) {
    if ($sdata['username'] != "register") {
	if ($sdata['type'] == "teamMember" || $sdata['type'] == "admin") {
	    echo "<li> My: </li>\n";
	    echo "<ul>\n";
	    echo "<li>" . anchor('/', "Dashboard") . "</li>\n";
            echo "<li>" . anchor('/profile', "Web Profile") . "</li>\n";
            echo "<li>" . anchor('/account', "Account") . "</li>\n";
            echo "<li>" . anchor('/econtact', "Emergency Contact") . "</li>\n";
	    echo "<li>" . anchor('/blog', "Write a Blog entry") . "</li>";
	    //echo "<li>" . anchor('/announce', "Announcments") . "</li>";
	    //echo "<li>" . anchor('/vocab', "Geek Speek") . "</li>";
	    //echo "<li>" . anchor('/stats', "Your Stats") . "</li>";
	    echo "</ul>\n";
	}
	if ($sdata['type'] == "student") {
	    echo "<li> My: </li>\n";
	    echo "<ul>\n";
	    echo "<li>" . anchor('/', "Dashboard") . "</li>\n";
//            echo "<li><a href=\"?page=manage.profile\"> Profile</a></li>\n";
//            echo "<li><a href=\"?page=manage.info\"> Information</a></li>\n";
//            echo "<li><a href=\"?page=manage.econtact\"> Emergency Contact</a></li>\n";
//            echo "<li><a href=\"?page=blog\"> Blog </a></li>";
	    echo "</ul>\n";
	}
	if ($sdata['type'] == "mentor") {
	    echo "<li> My </li>\n";
	    echo "<ul>\n";
	    echo "<li>" . anchor('/', "Dashboard") . "</li>\n";
	    echo "</ul>\n";

	    echo "<li> View </li>\n";
	    echo "<ul>\n";
            echo "<li>" . anchor('/einfo', "Emergency Info") . "</li>\n";
	    echo "</ul>\n";
	}
    }


//include "admin/nav.php";

    if ($sdata['type'] == "superuser" || $sdata['type'] == "admin" || $sdata['userid'] == 1) {
	echo "<li> Management: </li>";
	echo "<ul>";
	echo "<li>" . anchor("admin", "Admin Dash") . "</li>";
	echo "<li>" . anchor("admin/users", "User List") . "</li>";
	echo "<li>" . anchor("group", "Group List") . "</li>";
	echo "<li>" . anchor("admin/vocab", "Vocabulary") . "</li>";
	echo "<li>" . anchor("admin/reports", "Reports") . "</li>";
	echo "<li>" . anchor("admin/fb", "FB Post") . "</li>";

	echo "<li>" . anchor('admin/sms', "Team SMS") . "</li>";
	echo "<li>" . anchor('blog/admin', "Blogs") . "</li>";
	echo "<li>" . anchor('/announce/admin', "Announcments") . "</li>";
	echo "</ul>";
    }

//@todo bugs.php
//if (!($_REQUEST['page'] == "parts/bugs.php" || $_REQUEST['page'] == "register" || $_REQUEST['user'] == "register"))
//echo "<li><a href=\"?page=bugs.php&referrer=" . $sdata['REQUEST_URI'] . "\"> Report a Bug </a></li>\n";

    if ($sdata['username'] != "register")
        echo "<li>" . anchor('/auth/logout', "Logout") . "</li>\n";
    else
        echo "<li>" . anchor('/auth/logout', "Exit") . "</li>\n";



    echo "</ul>";

    if (!empty($sdata['username']) && $sdata['username'] != "register") {
	$str = "<br />\n";
	$str .= "Logged in as: \n";
	$str .= "<br />\n";
	$str .= anchor('/account', $sdata['username']) . "\n";


	echo $str;
    }
} else {
    echo "You are not currently logged in";
}
?>