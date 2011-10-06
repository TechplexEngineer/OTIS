<?php ui_render(); ?>

<div class="box">
	<h2>I believe you now, You can change your password.</h2>

    <fieldset style="width: 325px">
        <legend> Set your new password </legend>
		<?php
		echo form_open('/help/passchange');
		echo form_hidden('key', $key);
		echo form_hidden('uname', $uname);
		?>

		Password:
		<input type="password" name="passA" type="text" >
		Confirm:
		<input type="password" name="passB" type="text" >
		<input type="submit" name="Submit" value="Change my password" class="button">

		<?php echo form_close(); ?>

    </fieldset>
</div>