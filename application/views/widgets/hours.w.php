<?php

if ($type != "admin")
{
	echo "<div id=\"stats\" class=\"widget\">";
	//@todo stats loading
	if (empty($fhrs))
	{
		echo "<script>";
		echo "var fullname = \"" . $firstname . " " . $lastname . "\";";
        // /application/views/widgets/stats.w.php?name="+fullname
		echo "ajaxStats(fullname);";
		echo "</script>";

		echo "Loading Stats...";
		echo "<img alt=\"Loading Stats\"  src=\"application/media/img/ajax-loader.gif\"/>";
	} else
	{
		include "dashboard.stats.php";
	}
	echo "</div>";
}
?>