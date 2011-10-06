<!--@todo javascript alert-->
<h4>Web Profile</h4>
<strong>NOTE:</strong> Fields filled with [NONE] will not show on the website.
<br />

<form id="profile" name="profile" method="get" action="lib/preview.php">
    <table>
        <tr>
            <td><label for="myname">Hello, My name is:</label><td>
            <td><input type="text" readonly="readonly" name="myname" value="<?php echo $firstname; ?>"/><td>
        </tr>
        <tr>
            <td><label for="nickname">But I like to be called:</label><td>
            <td><input type="text" name="nickname" value="<?php echo $nickname; ?>"/><td>
        </tr>
        <tr>
            <td><label for="town">I live in:</label><td>
            <td><input type="text" name="town" value="<?php echo $location; ?>"/><td>
        </tr>
        <tr>
            <td><label for="role">My role on the team is:</label><td>
            <td><input type="text" name="role" value="<?php echo $role; ?>"/> **<td>
        </tr>
        <tr>
            <td><label for="yog">I will graduate High School in:</label><td>
            <td><input type="text" name="yog" value="<?php echo $yog; ?>"/> **<td>
        </tr>
        <tr>
            <td><label for="interests">Some of my interests are:</label><td>
            <td><input type="text" name="interests" value="<?php echo $interests; ?>"/><td>
        </tr>
        <tr>
            <td><label for="fav_moment">One of my favorite team moments:</label><td>
            <td><input type="text" name="fav_moment" value="<?php echo $favMoment; ?>"/><td>
        </tr>
        <tr>
            <td><label for="gain">I would like to gain the following this year:</label><td>
            <td><input type="text" name="gain" value="<?php echo $gainThisYr; ?>"/><td>
        </tr>
        <tr>
            <td><label for="future">My future plans include:</label><td>
            <td><input type="text" name="future" value="<?php echo $futurePlans; ?>"/> **<td>
        </tr>
        <tr>
            <td><label for="bio">My Bio:</label><td>
            <td><textarea name="bio" ><?php echo $bio; ?></textarea><td>
        </tr>
    </table>
    * All fields are required.<br>
	** Role, Future Plans, and Year of Graduation are required for members webpage
<?php
//	include "disclaimer.php";
// @todo add js validation of all fields filled in
?>
    <br/>
	<?php
//	if ((isset($_REQUEST['acceptID)))
//	{
//		echo "<input type=\"submit\" name=\"accept\" value=\" Approved \"/>";
//		echo "<input type = \"submit\" name = \"reject\" value = \" Pending \"/>";
//	}
//	else
//		echo "<input type=\"submit\" name=\"Submit\" value=\" I Agree, Preview \"/>";
	?>


</form>
