
<div class="box">

    <h1>Online Team Information System</h1>

    <?php
    $data = 'class="default-value login"';
    echo form_open('auth/authorize', 'id="frontend"') . "\n";
    echo "<div>";
    echo form_input('username', 'Username', $data) . "\n";
    echo form_password('password', 'Password', $data) . "\n";
    echo form_submit('submit', 'Login', 'class="button"');
    echo anchor('auth/register', 'Create Account', 'class="button"');
    echo anchor('help/forgot', 'Help', 'class="button"');
    echo banchor('/about', 'About');
    echo "</div>";
    echo form_close();
    ?>


</div><!-- end login_form-->
<div class="box counter">
    <script type="text/javascript">
	TargetDate = "2/21/2012 12:00 AM UTC -0500";
	BackColor = "";
	ForeColor = "black";
	CountActive = true;
	CountStepper = -1;
	LeadingZero = false;
	FinishMessage = "Build them Robots!";
	DisplayFormat = "%%D%% days and %%H%%:%%M%%:%%S%% until the end of build!";//+ FinishMessage;
    </script>
    <script  type="text/javascript" src="<?php echo MEDIAPATH; ?>js/countdown.js"></script>
</div><!-- end login_form-->
