<script type="text/javascript" >
    var firstname = "";
    var lastname = "";
    $(document).ready(function(){
	function makeUsrName()
	{
	    var username =firstname + "." + lastname;
	    $('#uname').val(username);
	}
	$('#fname').keyup(function(){
	    firstname = $('#fname').val();
	    makeUsrName()
	});
	$('#lname').keyup(function(){
	    lastname=$('#lname').val();
	    makeUsrName()
	});

    });
</script>
<noscript>
    This page uses Javascript. Your browser either
doesn't support Javascript or you have it turned off.
To see this page as it is meant to appear please use
a Javascript enabled browser.
</noscript>

<div class="box">
    <?php //$this->load->view('includes/header'); ?>

    <h1>Create an Account!</h1>
    <?php echo form_open('auth/create_user', 'id="frontend"'); ?>
    <fieldset>
	<legend>Personal Information</legend>
	<?php
	$data = 'class="default-value"';
	echo form_input('first_name', set_value('first_name', 'First Name'), $data . "id='fname'");
	echo form_input('last_name', set_value('last_name', 'Last Name'), $data . "id='lname'");
	echo form_input('email_address', set_value('email_address', 'Email Address'), $data);
	echo form_input('email_address2', set_value('email_address2', 'Email Confirm'), $data);

	//echo '<input type="text" name="first_name" placeholder="First Name" >';
	?>
    </fieldset>

    <fieldset>
	<legend>Login Info</legend>
	<?php
	echo "Username:" . form_input('username', set_value('username', 'Username'), 'readonly="readonly" id="uname"');
	echo "Password:" . form_password('password', set_value('password', ''), $data);
	echo "Password Confirm:" . form_password('password2', '', $data);
	$options = array(
	    'teamMember' => 'Team Member',
	    'mentor' => 'Mentor',
	    'alumni' => 'Alumni',
	    'parent' => 'Parent',
	);
	echo form_dropdown('type', $options, 'large');

	echo form_submit('submit', 'Create Acccount', 'class="button"');
	echo anchor('/auth', 'Back', 'class="button"');
	echo form_close();
	?>
    </fieldset>
    <?php echo validation_errors('<p class="verror">'); ?>

</div><!-- end login_form-->
