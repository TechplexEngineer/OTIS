<h5> Your Statistics </h5>
<hr>

<?php
//echo "You have:";
//echo "You have sepent ".$fundHours." Hours Fundraising.";
//echo "<br>";
//echo "You have Raised $".$fundDollars;
//echo "<br>";
//echo "You have ".$comService." Community Servide Hours.";
//echo "<br>";
//echo "You have ".$buildHours." build hours.";
?>
<br>
<div style="height: 150px;">
    <div style="float: left;">
	<strong style="text-decoration: underline;">You have:</strong><br/>
	<!--	<ul style="padding-left: 10px;">-->
	<table class="stats">
	    <?php
	    $fhreq = 30;
	    $fdreq = 300;
	    $creq = 5;
	    $breq = 40;
	    $dreq = 120;

	    setlocale(LC_MONETARY, 'en_US');
	    echo "<tr>";
	    echo "<td><strong>" . $fundHours . "</strong> of " . $fhreq . " Fundraising hours</td>";
	    $fhper = round((($fundHours / $fhreq) * 100), 2);
	    if ($fhper < 100)
		echo "<td>" . $fhper . "% completed</td>";
	    else
		echo "<td><strong>100% complete</strong></td>";
	    echo "</tr>";

	    echo "<tr>";
	    echo "<td><strong>$" . money_format('%i', $fundDollars) . "</strong> of " . $fdreq . " Fundraising dollars</td>";
	    $fdper = round((($fundDollars / $fdreq) * 100), 2);
	    if ($fdper < 100)
		echo "<td>" . $fdper . "% completed</td>";
	    else
		echo "<td><strong>100% complete</strong></td>";
	    echo "</tr>";

	    echo "<tr>";
	    echo "<td><strong>" . $comService . "</strong> of " . $creq . " Service Hours</td>";
	    $cper = round((($comService / $creq) * 100), 2);
	    if ($cper < 100)
		echo "<td>" . $cper . "% completed</td>";
	    else
		echo "<td><strong>100% complete</strong></td>";
	    echo "</tr>";

	    echo "<tr>";
	    echo "<td><strong>" . $buildHours . "</strong> of 40 Build hours</td>";
	    $bper = round((($buildHours / $breq) * 100), 2);
	    if ($bper < 100)
		echo "<td>" . $bper . "% completed</td>";
	    else
		echo "<td><strong>100% complete</strong></td>";
	    echo "</tr>";

	    echo "<tr>";
	    echo "<td><strong>" . $driveMins . "</strong> of 120 minutes driving</td>";
	    $dper = round((($driveMins / $dreq) * 100), 2);
	    if ($dper < 100)
		echo "<td>" . $dper . "% completed</td>";
	    else
		echo "<td><strong>100% complete</strong></td>";
	    echo "</tr>";

//	    echo "<li><strong>" . $fundHours . "</strong> of 30 fundraising hours</li>";
//	    echo "<li><strong>$" . money_format('%i', $fundDollars) . "</strong> of $300</li>";
//	    echo "<li><strong>" . $comService . "</strong> of 5 community service hours</li>";
//	    echo "<li><strong>" . $buildHours . "</strong> of 40 build hours " . round((($buildHours / $breq) * 100), 2) . "% done</li>";
//	    echo "<li><strong>" . $fundHours . "</strong> of 30 fundraising hours</li>";
//	    echo "<li><strong>$" . money_format('%i', $fundDollars) . "</strong> of $300</li>";
//	    echo "<li><strong>" . $comService . "</strong> of 5 community service hours</li>";
//	    echo "<li><strong>" . $buildHours . "</strong> of 40 build hours " . round((($buildHours / $breq) * 100), 2) . "% done</li>";
	    ?>
	</table>
	<!--	</ul>-->
    </div>
    <div style="float: right; width: 325px;">
	<strong style="text-decoration: underline;">Verdict:</strong><br/>
	<?php
	    setlocale(LC_MONETARY, 'en_US');
	    $pdecimal = $fundHours / $fhreq;
	    $percent = ($pdecimal * 100);


	    //Sadly they dont get more money if they get over 100% of their hours.
	    if ($percent >= 100)
		$percent = 100;



	    echo "You will have access to $" . money_format('%i', $fundDollars*($percent/100)) . ", which is " . round($percent,2) . "% of what you had raised.";
	    if($percent < 100)
		echo "You will also be expected to pay $50 towards the cost of attending the regional competiton.";
//
//	    echo "According to the policy you will have access to: $";
//	    if ($fundHours >= $fhreq)
//		echo money_format('%i', $fundDollars);
//	    else {
//		$percent = $fundHours / $fhreq;
//		$money = $percent * $fundDollars;
//		echo money_format('%i', $money);
//	    }
//	    echo " <br>Which you can use to offset the cost of transportation and/or Hotel costs."
	?>
    </div>
    <div class="clear"></div>
</div>

<br><br>
<strong style="text-decoration: underline;">The Policy:</strong>
<ol style="padding-left: 20px;">
    <li>If a team member reaches the 30 hours of fundraising, they have access to 100% of the money they raised. This money will act to offset the costs of hotels and transportation, NOT FOOD for regional, world championships, and off-season events.</li>
    <li>If a team member doesn't reach the 30 hours, they are responsible for $50 per regional and the world championship registration fee, and a portion of the off-season registration costs.</li>
    <li>There is no compensation for going over the 30 hours.</li>
    <li> Any money raised beyond the $300 is credited to the team member, but it can only cover hotels and transportation, NOT food!</li>
</ol>

<br><br>
<strong style="text-decoration: underline;">The Driving Policy:</strong>
For a team member to be eligible to drive at a regional competition, they must:
<ol style="padding-left: 20px;">
    <li>Operate the robot for at least 120 minutes prior to the regional competition.</li>
    <li>Pass a written test on the rules with an 95% or better.</li>
</ol>

