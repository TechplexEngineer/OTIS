<style type="text/css">
table.sample {
	border-width: 0px;
	/*border-spacing: ;*/
	border-style: hidden;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 1px;
	padding: 2px 10px 2px 10px;
	border-style: inset;
	border-color: gray;
	background-color: #eee;
	font-weight: bold;
	/*-moz-border-radius: ;*/
}
table.sample td {
	border-width: 1px;
	padding: 5px;
	border-style: inset;
	border-color: gray;
	background-color: white;
	/*-moz-border-radius: ;*/
}
dt{
    font-weight: bold;
}
.button
{
    font-size: 10px;
    padding: 2px;
}
</style>
<h5> Manage FRC Vocabulary Words </h5>
<hr>
<br>
<?php
echo banchor('/admin/vocab/add', "Add a Word") . "<br><br>";
$sql= "Select * FROM vocab ORDER BY word ASC ";
$qry = mysql_query($sql) or die(mysql_error());
echo "<dl>";
while ($row = mysql_fetch_assoc($qry))
{
    echo "<dt>".banchor('/admin/vocab/edit/'.urlencode($row['word']), "edit").$row['word']." &nbsp; &nbsp; ".  " </dt>";
    echo "<dd> &nbsp; &nbsp; --".$row['def']."</dd>";
}
echo "</dl>";
//echo "<table class=\"sample\">";
//echo "<tr>";
//echo "
//      <th>  </th>
//      <th> Date </th>
//      <th> Post </th>
//      <th> Author </th>
//      <th> Status </th>";
//echo "</tr>";
//while ($row = mysql_fetch_assoc($qry))
//{
//    echo "<tr>";
//    echo "<td>";
//        echo $row['id'];
//    echo "</td>";
//
//    echo "<td>";
//        echo $row['title'];
//    echo "</td>";
//
//    echo "<td>";
//        echo $row['date'];
//    echo "</td>";
//    echo "<td>";
//        echo anchor("/blog/admin/edit/".$row['id'], "edit & view post");
//    echo "</td>";
//    echo "<td>";
//        echo $row['author'];
//    echo "</td>";
//    echo "<td>";
//        if($row['approved'])
//            echo "Approved";
//        else
//            echo "pending";
//    echo "</td>";
//    echo "</tr>";
//}
//echo "</table>";
?>