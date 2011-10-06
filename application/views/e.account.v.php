<?php //ui_render(); ?>
<fieldset>
	<legend>Account Information</legend>


	<strong>NOTE:</strong> None of the information provided in this form is accessible to the public.
	<br />
	<!--<form id="profile" name="profile" method="get" action="pages/edit.info.php">-->
	<?php
	if (empty($act))
	{
		echo form_open('account/update');
		echo form_hidden('id', $this->session->userdata('userid'));
		//style="width: 150%;"
	}
	?>
	<input type="hidden" name="form" value="info" >
	<table style="width: 100%;">
		<tr>
			<td style="width: 225px;"><label for="myname">Hello, My name is:</label><td>
			<td ><input type="text" readonly="readonly" name="myname2" value="<?php echo $firstname . " " . $lastname; ?>"/><td>
		</tr>
		<tr>
			<td><label for="email">My Email Address is:</label><td>
			<td><input type="text" name="email" style="width: 100%;" value="<?php echo $email; //@todo email is in a diff table    ?>"/><td>
		</tr>
		<tr>
			<td><label for="mailaddress">My Full Mailing Address is:</label><td>
			<td><input type="text" name="mailaddress" style="width: 100%;" value="<?php echo $mailaddress; ?>"/><td>
		</tr>
		<tr>
			<td><label for="homephone">My Home Phone number is:</label><td>
			<td><input type="text" name="homephone" value="<?php echo $homephone; ?>"/><td>
		</tr>
		<tr>
			<td><label for="cellphone">My Cell Phone number is:</label><td>
			<td><input type="text" name="cellphone"  value="<?php echo $cellphone; ?>"/><td>
		</tr>
		<tr>
			<td><label for="medications">The Medications I take are:</label><td>
			<td><textarea  name="medications" ><?php echo $medications; ?></textarea><td>
		</tr>
	</table>
	All fields are required, you may enter [NONE] where applicable
	<?php

	// We need to make sure that the email is valid.
	if (empty($act))
	{
		//include "disclaimer.php";
		echo "<br>";
		echo form_submit('submit', 'I agree. Submit');
		echo "</form>";
	}
	?>
</fieldset>