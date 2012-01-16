
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <!-- Javascript - Fix the flash of unstyled content -->
        <script type="text/javascript"></script>

        <!-- Stylesheets -->
        <link href="<?php echo MEDIAPATH; ?>css/reset.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo MEDIAPATH; ?>css/default.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo MEDIAPATH; ?>css/styling.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel='stylesheet' href='<?php echo MEDIAPATH; ?>css/ui.style.css' type='text/css' media='screen'/>
        <!--Validation-->

        <script src="<?php echo MEDIAPATH; ?>js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo MEDIAPATH; ?>js/common.js" type="text/javascript"></script>


        <!-- Meta Information -->
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="author" content="Techplex Engineer" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />

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
        <div id="container">
            <div id="header">
                <div id="header-in">
                    <h2><?php echo $header; ?></h2>
                    <h6><?php echo $desc; ?></h6>
                </div> <!-- end #header-in -->
            </div> <!-- end #header -->
            <div id="content-wrap" class="clear lcol">
                <div class="column">
                    <div class="column-in">
			<?php echo $nav; ?>
                    </div>
                </div>
                <div class="content">
                    <div class="content-in">
			<?php
			ui_render();

			echo $body;
			?>
                    </div><!-- end .content-in -->
                </div> <!-- end .content -->
            </div> <!-- end #content-wrap -->
            <div id="footer">
                <div id="footer-in">
		    <?php echo $footer; ?>
                </div> <!-- end #footer-in -->
            </div> <!-- end #footer -->
        </div> <!-- end div#container -->
    </body>
</html>