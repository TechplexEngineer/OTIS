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
//include "functions.php";
//include "lookup.php";

$dbhost = 'localhost';
$dbuser = 'OIS';
$dbpass = 'informatics';
$dbname = 'OIS';
$user_table = 'users';

mysql_connect($dbhost, $dbuser, $dbpass) or die('ERROR: CANNOT CONNECT TO DATABASE.');
mysql_select_db($dbname) or die('ERROR: CANNOT SELECT DATABASE. \n' . mysql_error());

$sql = "SELECT * FROM `profile` ORDER BY yog, id"; //where approved
$qry = mysql_query($sql) or die(mysql_error());

//=====

function getFirstName($id) {
    //include "vars.php";
    $sql = "SELECT * FROM users WHERE id = '" . $id . "'";
    $qry = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($qry);
    return $row['firstname'];
}

function YOG($yog) {
    $year = date('Y');
    $month = date('m');

    if ($month < 6) {
	if ($yog - $year == 0)
	    return "Senior";
	elseif ($yog - $year == 1)
	    return "Junior";
	elseif ($yog - $year == 2)
	    return "Sophomore";
	elseif ($yog - $year == 3)
	    return "Freshman";
	else
	    return "ERROR";
    }else {
	if ($yog - $year == 0)
	    return "Alumni";
	elseif ($yog - $year == 1)
	    return "Senior";
	elseif ($yog - $year == 2)
	    return "Junior";
	elseif ($yog - $year == 3)
	    return "Sophomore";
	elseif ($yog - $year == 4)
	    return "Freshman";
	else
	    return "ERROR";
    }
}

function gradYr($yog) {
    return YOG($yog);
}

//=====

$rows; // will contain all the users
$seniors = array();
$juniors = array();
$sophomores = array();
$freshmen = array();

$alumni = array();
while ($row = mysql_fetch_assoc($qry)) {
    //@todo there is probably a better way to do this
    //print_r($row);

    $row['name'] = getFirstName($row['id']);
    $rows[] = $row;

    switch (gradYr($row['yog'])) {
	case "Senior":
	    $seniors[] = $row;
	    break;
	case "Junior":
	    $juniors[] = $row;
	    break;
	case "Sophomore":
	    $sophomores[] = $row;
	    break;
	case "Freshman":
	    $freshmen[] = $row;
	    break;
	case "ERROR":
	    break;
	default:
	    $alumni[] = $row;
	    break;
    }
}

//print_r($seniors);
function cmp($a, $b) {
    return strcmp(strtolower($a['name']), strtolower($b['name']));
}

usort($seniors, "cmp");
usort($juniors, "cmp");
usort($sophomores, "cmp");
usort($freshmen, "cmp");
usort($alumni, "cmp");

//print_r($seniors);
//$countNicks =0;

$grades = array("Seniors" => $seniors, "Juniors" => $juniors, "Sophomores" => $sophomores, "Freshmen" => $freshmen, "Alumni" => $alumni);
foreach ($grades as $name => $grade) {
    //print_r($grade);// $name . $grade;
    if (($numRows = ceil(count($grade) / 2)) != 0) {
	echo "<h2 class=\"label\"> " . $name . " </h2>"; // label at the top of a class, ie: seniors, juniors, soph, fresh

	echo "<table class=\"sample\" id=\" " . $name . " \">\n";
	$i = 0;
	for ($i; $i < 2 * $numRows; $i +=2) {
	    //if($grade[$i]["name"]=="Nick")
	    //$countNicks++;
	    echo "\t<tr>\n";

	    echo "\t\t<td width = \"25% \">\n";
	    $path = "2011/members/";


	    $img = $path . strtolower($grade[$i]["id"]."_".$grade[$i]["name"]) . ".jpg";
	    //if($countNicks >0 && $countNicks <2)
	    //$img = $path.strtolower ( $grade[$i]["name"])."g.jpg";

	    if (isset($grade[$i]["name"]) && file_exists($img))
		echo "<img src=\"../" . $img . "\" width=\"100%\" alt=\"" . $grade[$i]["name"] . "\"/>";
	    else
		echo "We don't have a picture for " . $grade[$i]["name"];
	    echo "\t\t</td>\n";


	    echo "\t\t<td width = \"25% \" align = \" center \" >\n";
	    echo "\t\t\t <h3 style = \"margin: 10px 0px 0px 0px;\">" . $grade[$i]["name"] . " </h3>";
	    if ($grade[$i]["name"] != $grade[$i]["nickname"] && $grade[$i]["nickname"] != "[NONE]")
		echo "(" . $grade[$i]["nickname"] . ")" . "<br />";
	    echo "<br />";
	    echo "\t\t\t" . $grade[$i]["role"] . "<br />" . "<br />" . $grade[$i]["futurePlans"] . "\n";
	    echo "\t\t</td>\n";


	    echo "\t\t<td width = \"25% \" align = \" center \" style=\"border-left: 1px solid #ffffff;\" >\n";
	    echo "\t\t\t <h3 style = \"margin: 10px 0px 0px 0px;\">" . $grade[$i + 1]["name"] . " </h3>";
	    if ($grade[$i + 1]["name"] != $grade[$i + 1]["nickname"] && $grade[$i + 1]["nickname"] != "[NONE]")
		echo "(" . $grade[$i + 1]["nickname"] . ")" . "<br />";
	    echo "<br />";
	    echo "\t\t\t" . $grade[$i + 1]["role"] . "<br />" . "<br />" . $grade[$i + 1]["futurePlans"] . "\n";
	    echo "\t\t</td>\n";
	    echo "\t\t<td width = \"25% \">\n";

	    $img2 = $path . strtolower($grade[$i+1]["id"]."_".$grade[$i+1]["name"]) . ".jpg";

	    //if($grade[$i+1]["name"]=="Nick")
	    //$countNicks++;
	    //if($countNicks >0 && $countNicks <2)
	    //$img2 = $path.strtolower ( $grade[$i+1]["name"])."g.jpg";


	    if (isset($grade[$i + 1]["name"]) && file_exists($img2))
		echo "<img src=\"../" . $img2 . "\" width=\"100%\" alt=\"" . $grade[$i + 1]["name"] . "\"/>";
	    else if (isset($grade[$i + 1]["name"]))
		echo "We don't have a picture for " . $grade[$i + 1]["name"];
	    echo "\t\t</td>\n";
	    echo "\t</tr>\n";
	}
	echo "</table>";
	echo "<hr />";
    }
    /* else
      if($name != "Alumni")
      echo "<h4> There are no ".$name." on the team this year </h4>";
      else
      echo "<h4> There are currently no Alumni in the system </h4>";

     */
}
?>
