<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><title><?php echo $title; ?></title>

	<link href="<?php echo base_url() . 'application/media/'; ?>css/new/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel='stylesheet' href='/application/media/css/ui.style.css' type='text/css' media='screen'/>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<script type="text/javascript" src="/application/media/js/jquery.js"></script>
	<script type="text/javascript" >
	    $(document).ready(function() {
		$('.default-value').each(function() {
		    var default_value = this.value;
		    $(this).css('color', '#666'); // this could be in the style sheet instead
		    $(this).focus(function() {
			if(this.value == default_value) {
			    this.value = '';
			    $(this).css('color', '#333');
			}
		    });
		    $(this).blur(function() {
			if(this.value == '') {
			    $(this).css('color', '#666');
			    this.value = default_value;
			}
		    });
		});
	    });
	</script>
	<?php echo $head . "\n"; ?>

	<script type="text/javascript">

	    var _gaq = _gaq || [];
	    _gaq.push(['_setAccount', 'UA-10899272-11']);
	    _gaq.push(['_trackPageview']);

	    (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	    })();

	</script>

    </head>
    <body>
	<?php
	ui_render();
	echo $body . "\n";
	?>
	<div id="footbar">
	    <?php echo $footer . "\n"; ?>
	</div>
    </body>
</html>