
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
 The robot has shipped, now its: <br>
    <script type="text/javascript">
	TargetDate = "<?php echo $date?>";//"4/7/2011 3:00 PM UTC -0500";
	BackColor = "";
	ForeColor = "black";
	CountActive = true;
	CountStepper = -1;
	LeadingZero = false;
	FinishMessage = "FInish Message";
	DisplayFormat = "%%D%% days and %%H%%:%%M%%:%%S%% until ";//+ FinishMessage;
		
    </script>
    <script  type="text/javascript" src="/application/media/js/countdown.js"></script>
      the Boston Regional.
</div><!-- end login_form-->
