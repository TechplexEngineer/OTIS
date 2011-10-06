<style type="text/css">
    table.sample {
        width: 100%;
        border-width: 1px;
        border-style: hidden;
        border-color: gray;
        border-collapse: collapse;

    }
    table.sample th {
        border-width: 1px;
        padding: 3px;
        border-style: inset;
        border-color: gray;

    }
    table.sample td {
        border-width: 1px;
        border-bottom: 1px solid #ffffff;
        padding: 3px;
        /*border-style: inset;
	border-color: gray;*/


    }
    td {
        vertical-align: top;
    }

    h2.label
    {
        color: #C04E06;
        text-align: center;
    }

</style>

<?php
$grades = array("Seniors" => $seniors, "Juniors" => $juniors, "Sophomores" => $sophomores, "Freshmen" => $freshmen, "Alumni" => $alumni);
foreach ($grades as $name => $grade)
{
	if (($numRows = ceil(count($grade) / 2)) != 0)
	{
		echo "<h2 class=\"label\"> " . $name . " </h2>";
		echo "<table class=\"sample\" id=\" " . $name . " \">\n";
		$i = 0;
		for ($i; $i < 2 * $numRows; $i +=2)
		{
			echo "<tr>\n";

			echo "<td width = \"25% \">\n";
			$path = "http://www.team2648.com/2011/people/";


			$img = $path . strtolower($grade[$i]["name"]) . ".jpg";

			//echo $img;
			if (isset($grade[$i]["name"]))
			{
				if (@fclose(@fopen($img, "r")))
				//if (isset($grade[$i]["name"]) && file_exists($img))
					echo "<img src=\"" . $img . "\" width=\"100%\"/>";
				//echo "<img src=\"\" width=\"100%\"/>";
				else
					echo "We don't have a picture for " . $grade[$i]["name"];
				echo "</td>\n";


				echo "<td width = \"25% \" align = \" center \" >\n";
				echo " <H3 style = \"margin: 10px 0px 0px 0px;\">" . $grade[$i]["name"] . " </H3>";
				if ($grade[$i]["name"] != $grade[$i]["nickname"] && $grade[$i]["nickname"] != "[NONE]")
					echo "(" . $grade[$i]["nickname"] . ")" . "<br />";
				echo "<br />";
				echo "" . $grade[$i]["role"] . "<br />" . "<br />" . $grade[$i]["futurePlans"] . "\n";
				echo "</td>\n";
			}
			if (isset($grade[$i + 1]["name"]))
			{

				echo "<td width = \"25% \" align = \" center \" style=\"border-left: 1px solid #ffffff;\" >\n";
				echo " <h3 style = \"margin: 10px 0px 0px 0px;\">" . $grade[$i + 1]["name"] . " </h3>";
				if ($grade[$i + 1]["name"] != $grade[$i + 1]["nickname"] && $grade[$i + 1]["nickname"] != "[NONE]")
					echo "(" . $grade[$i + 1]["nickname"] . ")" . "<br />";
				echo "<br />";
				echo "" . $grade[$i + 1]["role"] . "<br />" . "<br />" . $grade[$i + 1]["futurePlans"] . "\n";
				echo "</td>\n";
				echo "<td width = \"25% \">\n";

				$img2 = $path . strtolower($grade[$i + 1]["name"]) . ".jpg";

				//if (isset($grade[$i + 1]["name"]) && file_exists($img2))
				if (isset($grade[$i]["name"]) && @fclose(@fopen($img2, "r")))
					echo "<img src=\"" . $img2 . "\" width=\"100%\"/>";
				else if (isset($grade[$i + 1]["name"]))
					echo "We don't have a picture for " . $grade[$i + 1]["name"];
			}
			echo "</td>\n";
			echo "</tr>\n";
		}
		echo "</table>";
		echo "<hr>";
	}
	/* else
	  if($name != "Alumni")
	  echo "<h4> There are no ".$name." on the team this year </h4>";
	  else
	  echo "<h4> There are currently no Alumni in the system </h4>";

	  Technology, Electronics, Process Automation, Systems Architecture and Design
	  Is when we won the Best BattleCry Award at BattleCry 11 @ WPI
	  The ability to better lead and manage the team.
	  College, Engineering, Silicon Valley, Google, My own Company


	 */
}
?>

