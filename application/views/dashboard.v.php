<?php

//Session data array
$sdata = $this->session->all_userdata();


echo "<h5>Welcome to your personal dashboard " . $sdata['username'] . "</h5>";
echo "<hr>";
echo "<div class=\"left\">";
if($sdata['type']=="teamMember" || $sdata['type']=="admin")
{
	//nagbox
	$this->load->view('widgets/nagbox.w.php',$data['nagbox'] = $nagbox);

	//Hours
//	$datas['fundHours'] = $cit->session->userdata('fundHours');
//	$datas['fundDollars'] = $cit->session->userdata('fundDollars');
//	$datas['comService'] = $cit->session->userdata('comService');
//	$datas['buildHours'] = $cit->session->userdata('buildHours');
	$sdata['stats'] = null;//$datas;
	$this->load->view('widgets/hours.w.php',$sdata);

	//Calendar Widget
	$this->load->view('widgets/cal.w.php');

}

if($sdata['userid']==1 || $sdata['type']=="admin")//if($sdata['type']=="admin" || $sdata['username'] == "blake.bourque")

{
	$this->load->view('widgets/blogcount.w.php');
}

//if ($sdata['username'] == "blake.bourque" || $sdata['username'] == "miss.luce") // It it blake or missluce
//{
//    echo "<div id=\"logins\" class=\"widget\">";
//    echo "<form name=\"controlsForm\">";
//    if($loginsDisabled) //@todo fix login enabler
//        $cblogin = "checked=\"yes\"";
//    else
//        $cblogin = "";
//    echo "<input id=\"cblogin\" type=\"checkbox\" name=\"loginbox\" ".$cblogin." onClick=\"login()\"/> Disable Login<br />";
//    if($registrationDisabled)
//        $cbreg = "checked=\"yes\"";
//    else
//        $cbreg = "";
//    echo "<input id=\"cbreg\" type=\"checkbox\" name=\"regbox\" ".$cbreg." onClick=\"reg()\"/> Disable Registration<br />";
//    echo "</form>";
//    echo "</div>";
//}

echo "</div>";

?>


<div class="clear"></div>
