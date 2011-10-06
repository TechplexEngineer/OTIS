<?php //ui_render();   ?>
<fieldset>
    <?php
    if (empty($actName)) {
	echo "<legend>Emergency Contact</legend>";
    } else {
	echo "<legend>Emergency Contact info for ".$actName."</legend>";
	//echo "<legend>Emergency: for ".$actName."<legend>";
    } ?>
    <strong>NOTE:</strong> None of the information provided in this form is accessible to the public.


    <!--<form id="profile" name="profile" method="get" action="pages/edit.econtact.php">-->
<?php
    if (empty($act)) {
	echo "<br/><br/> <strong>===>This is who we should contact when we are away as a team.</strong>";
	echo form_open('econtact/update');
	echo form_hidden('id', $this->session->userdata('userid'));
    }
?>

    <table style="width: 100%;">
	<tr>
	    <td style="width: 225px;"><label for="fullname">Name of emergency contact:</label><td>
	    <td><input type="text" name="fullname" value="<?php echo $fullname; ?>"/><td>
	</tr>
	<tr>
	    <td><label for="email">Email Address:</label><td>
	    <td><input type="text" name="email" style="width: 100%;" value="<?php echo $email; ?>"/><td>
	</tr>
	<tr>
	    <td><label for="mailingaddress">Mailing Address</label><td>
	    <td><input type="text" name="mailingaddress" style="width: 100%;" value="<?php echo $mailingaddress; ?>"/><td>
	</tr>
	<tr>
	    <td><label for="homephone">Home Phone:</label><td>
	    <td><input type="text" name="homephone" value="<?php echo $homephone; ?>"/><td>
	</tr>
	<tr>
	    <td><label for="workphone">Work Phone:</label><td>
	    <td><input type="text" name="workphone" value="<?php echo $workphone; ?>"/><td>
	</tr>
	<tr>
	    <td><label for="cellphone">Cell Phone:</label><td>
	    <td><input type="text" name="cellphone" value="<?php echo $cellphone; ?>"/><td>
	</tr>
	<tr>
	    <td><label for="relation">Relation:</label><td>
	    <td><input type="text" name="relation" value="<?php echo $relation;  // @todo dropdown      ?>"/><td>
	</tr>

	<tr>
	    <td><label for="bestway">The best way to contact this person is:</label><td>
	    <td><!-- would a dropdown suffice? -->
		<textarea style="width:75%;" name="bestway" ><?php echo $bestway; ?></textarea>
	    <td>
	</tr>
    </table>
    All fields are required, you may enter [NONE] where applicable
<?php
    if (empty($act)) {
	//include "disclaimer.php";
	echo "<br>";
	echo form_submit('submit', 'I agree. Submit');
	echo "</form>";
    }
?>
</fieldset>