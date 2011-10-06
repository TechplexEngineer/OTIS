<?php
//$this->load->helper('html');
echo link_tag('application/media/css/new/table_style.css');
?>
<h5> Listing of Groups </h5>
<hr>
<br>
<table class="list">
	<tr>
		<th> Group ID </th>
		<th> Title </th>
		<th> Description </th>
		<th> List Members </th>
		<th> Add Members </th>
	</tr>
	<?php
	foreach ($groups as $val)
	{
		echo '<tr>';
		echo '<td>' . $val['groupid'] . '</td>';
		echo '<td>' . $val['title'] . '</td>';
		echo '<td>' . $val['desc'] . '</td>';
		echo '<td>' . anchor('group/list_users/'.$val['groupid'], 'List') . '</td>';
		echo '<td>' . anchor('group/add_user/'.$val['groupid'], 'Add') . '</td>';
		echo '</tr>';
	} ?>
</table>

<?php
	echo "<br>" . banchor('group/create', "Create a new group");
?>