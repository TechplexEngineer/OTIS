<style type="text/css">
    dt{
	font-weight: bold;
	text-decoration: underline;
    }
    a.anchor
    {
	color: white;
    }

</style>
<script src="http://team2648.com/ois/application/media/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" >
    function highlight(tag){
	
	tag=tag.substring(1, tag.length)
	console.log(tag);
	var tag1 = document.getElementsByTagName(tag);
	//var elem = $(elemId);
	console.log(tag1);

	console.log(tag);
	var tag1 = document.getElementById(tag);
	//var elem = $(elemId);
	console.log("Id: "+tag1)
	
	//elem.css("backgroundColor", "#ffffaa"); // hack for Safari
	//elem.animate({ backgroundColor: '#ffffaa' }, 1500);
	//setTimeout(function(){$(elemId).animate({ backgroundColor: "#ffffff" }, 3000)},1000);
    }

    if (document.location.hash) {
	highlight(document.location.hash);
    }
    $('a[href*=#]').click(function(){
	var elemId = '#' + $(this).attr('href').split('#')[1];
	highlight(elemId);
    });
</script>

<?php
$dbhost = 'localhost';
$dbuser = 'OIS';
$dbpass = 'informatics';
$dbname = 'OIS';
$user_table = 'users';

mysql_connect($dbhost, $dbuser, $dbpass) or die('ERROR: CANNOT CONNECT TO DATABASE.');
mysql_select_db($dbname) or die('ERROR: CANNOT SELECT DATABASE. \n' . mysql_error());

$sql = "Select * FROM vocab ORDER BY word ASC ";
$qry = mysql_query($sql) or die(mysql_error());
echo "<dl>";
while ($row = mysql_fetch_assoc($qry)) {
    echo "<a class=\"anchor\" name=\"" . $row['word'] . "\" id=\"" . $row['word'] . "\">";
    echo "<dt> " . $row['word'] . " </dt>";
    echo "<dd> &nbsp; &nbsp;"  . $row['def'] . "</dd>";
    echo"<br></a>";
}
echo "</dl>";
?>