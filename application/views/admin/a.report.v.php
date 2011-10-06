<?php
// howmany people have completed their web profile
// imformation
// emergency contact



echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('wp');\"/>\n";
echo "<b>web pending: ". count($web_pending)."</b>\n<br>";
echo "<div id=\"wp\">";
foreach($web_pending as $row)
   echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
echo "</div>";

echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('wa');\"/>\n";
echo "<b>web approved: ". count($web_approved)."</b>\n<br>";
echo "<div id=\"wa\">";
foreach($web_approved as $row)
   echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
echo "</div>";

echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('wi');\"/>\n";
echo "<b>web incomplete: ". count($web_incomplete)."</b>\n<br>";
echo "<div id=\"wi\">";
foreach($web_incomplete as $row)
   echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
echo "</div>";

//==============================================================================

echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('ic');\"/>\n";
echo "<b>account complete ". count($account_complete)."</b>\n<br>";
echo "<div id=\"ic\">";
foreach($account_complete as $row)
   echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
echo "</div>";

echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('ii');\"/>\n";
echo "<b>account incomplete ". count($account_incomplete)."</b>\n<br>";
echo "<div id=\"ii\">";
foreach($account_incomplete as $row)
    echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
//<a href=\"?page=view&id=" . $row["id"] . "\">".$row['user']."</a>
echo "</div>";

//==============================================================================

echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('ec');\"/>\n";
echo "<b>econtact complete ". count($econtact_complete)."</b>\n<br>";
echo "<div id=\"ec\">";
foreach($econtact_complete as $row)
   echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
echo "</div>";

echo "<input type=\"checkbox\" name=\"todo\" value=\"\" onclick=\"toggleVisID('ei');\"/>\n";
echo "<b>econtact incomplete ". count($econtact_incomplete)."</b>\n<br>";
echo "<div id=\"ei\">";
foreach($econtact_incomplete as $row)
   echo anchor("admin/user_edit/".$row["id"], $row['user'])." \n <br>";
echo "</div>";


//print_r($econtact_incomplete);

//loop through the array pull usernames "user" print


/*

for ever user that is a teammember
    WEB:
    count pending
    count approved
    count incomplete

    profile:
    complete
    incomplete

    econtact:
    complete
    imcomplete
*/

?>