<?php $bfig = $this->config->item('bfig'); ?>
<html>
	<head><title><?php echo $bfig['title']; ?></title>
		<link rel="stylesheet" href="<?php echo MEDIAPATH; ?>css/styling.css"type="text/css" media="screen">
		
	</head>
	<body>
		<?php ui_render(); ?>
		<center><h2> <?php echo $bfig['sysname']; ?> </h2></center>

		<!--<form name="form1" method="post" action="<?php //echo base_url() . index_page();   ?>/login/auth">-->
		<center>
		<?php echo form_open('/auth/authorize'); ?>
		
			<fieldset class="quarter">
				<legend>Login:</legend>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" >
					<tr>
						<td width="78">Username</td>
						<td width="6">:</td>
						<td width="294"><input class="full" name="user" type="text" id="myusername"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input class="full" name="passwd" type="password" id="mypassword"></td>
					</tr>
					<tr>
						<td> &nbsp; <a href="/help/forgot">Help</a></td>
						<td> &nbsp;</td>
						<td><input type="submit" name="Submit" value="Login"></td>
					</tr>
				</table>
			</fieldset>
		
	</form>
	</center>
	<center>
		<fieldset style="width: 25%">

			<script language="JavaScript">
				TargetDate = "1/8/2011 11:00 AM UTC-0500";
				BackColor = "";
				ForeColor = "black";
				CountActive = true;
				CountStepper = -1;
				LeadingZero = false;
				DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds Until Kickoff";
				FinishMessage = "Kickoff!";
			</script>
			<script language="JavaScript" src="http://scripts.hashemian.com/js/countdown.js"></script>

		</fieldset>
	</center>
</body>
</html>