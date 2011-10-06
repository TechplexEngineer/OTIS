<fieldset>
	<legend> I forgot my <strong>Password</strong>: </legend>
	<?php
	$data = 'class="default-value"';
	echo form_open('/help/fpass') . "\n";
	echo form_input('username', 'Username', $data) . "\n";
	echo form_submit('submit', 'Help Me With My Password', 'class="button"');
	echo form_close();
	?>
</fieldset>
