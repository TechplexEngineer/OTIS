<fieldset>
	<legend> I forgot my <strong>Username</strong>: </legend>
	<?php
	$data = 'class="default-value"';
	echo form_open('/help/fuser') . "\n";
	echo form_input('firstname', 'First Name', $data) . "\n";
	echo form_submit('submit', 'Help Me With My Username', 'class="button"');
	echo form_close();
	?>
</fieldset>
