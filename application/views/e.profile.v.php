<!--@todo javascript alert-->


<?php //ui_render(); ?>

<fieldset>
	<legend>Web Profile</legend>

	<?php

	if (empty($act))
	{
		echo form_open('profile/preview');
		echo form_hidden('id', $this->session->userdata('userid'));
	}
	else
		echo form_hidden('id', $uid);
	?>
	<!--<form id="profile" name="profile" method="get" action="lib/preview.php">-->
	<table style="width: 100%;">
		<tr>
			<td style="width: 250px;"><label for="myname">Hello, My name is:</label><td>
			<td ><input type="text" readonly="readonly" name="myname" value="<?php echo $firstname; ?>"/><td>
		</tr>
		<tr>
			<td><label for="nickname">My nickname is:</label><td>
			<td><input type="text" name="nickname" style="width: 100%;" value="<?php echo $nickname; ?>"/><td>
		</tr>
		<tr>
			<td><label for="town">I live in:</label><td>
			<td><input type="text" name="town" style="width: 100%;" value="<?php echo $location; ?>"/><td>
		</tr>
		<tr>
			<td><label for="role">My role on the team is: ** </label><td>
			<td><input type="text" name="role"  value="<?php echo $role; ?>"/><td>
		</tr>
		<tr>
			<td><label for="yog">My year of Graduation is: ** </label><td>
			<td><input type="text" name="yog"  value="<?php echo $yog; ?>"/><td>
		</tr>
		<tr>
			<td><label for="interests">I am interested in:</label><td>
			<td><input type="text" name="interests"  style="width: 100%;" value="<?php echo $interests; ?>"/><td>
		</tr>
		<tr>
			<td><label for="fav_moment">My favorite team moment is:</label><td>
			<td><input type="text" name="fav_moment" style="width: 100%;" value="<?php echo $favMoment; ?>"/><td>
		</tr>
		<tr>
			<td><label for="gain">This season I will:</label><td>
			<td><input type="text" name="gain" style="width: 100%;" value="<?php echo $gainThisYr; ?>"/><td>
		</tr>
		<tr>
			<td><label for="future">My future plans include: ** </label><td>
			<td><input type="text" name="future" style="width: 100%;" value="<?php echo $futurePlans; ?>"/> <td>
		</tr>
		<tr class="hide">
			<td><label for="bio">My Bio:</label><td>
			<td><textarea name="bio" ><?php echo $bio; ?></textarea><td>
		</tr>
	</table>
	<!--* All fields are required.--><br>
			** Role, Future Plans, and Year of Graduation are required for team members webpage

	<!--include "disclaimer.php";-->
	<?php
	//@todo this might be the answer to team pics
	//echo form_upload("file", "abc")

	if (empty($act))
	{
		echo '<br>';
		echo '<br>';
		echo form_submit('submit', 'I agree. Preview');
		echo "<br/>";
		echo "</form>";
	}
	?>

</fieldset>


