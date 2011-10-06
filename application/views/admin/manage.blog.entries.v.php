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
</style>
<h5> Manage Web Log Entries </h5>
<hr>
<br>
<?php
$sql= "Select * FROM blog ORDER BY mdate DESC ";
$qry = mysql_query($sql) or die(mysql_error());


echo "<table class=\"sample\">";
echo "<tr>";
echo "<th> ID </th>
      <th>Title </th>
      <th> Date </th>
      <th> Post </th>
      <th> Author </th>
      <th> Status </th>";
echo "</tr>";
while ($row = mysql_fetch_assoc($qry))
{
    echo "<tr>";
    echo "<td>";
        echo $row['id'];
    echo "</td>";

    echo "<td>";
        echo $row['title'];
    echo "</td>";

    echo "<td>";
        echo $row['date'];
    echo "</td>";
    echo "<td>";
        echo anchor("/blog/admin/edit/".$row['id'], "edit & view post");
    echo "</td>";
    echo "<td>";
        echo $row['author'];
    echo "</td>";
    echo "<td>";
        if($row['approved'])
            echo "Approved";
        else
            echo "pending";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>
