<script src="http://otis.team2648.com/application/media/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo MEDIAPATH; ?>js/datatable/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MEDIAPATH; ?>css/demo_table.css" />

<script>
    var tbl;
    function fnShowHide( iCol ){
	/* Get the DataTables object again - this is not a recreation, just a get of the object */
	var oTable = $('#two').dataTable();

	var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	oTable.fnSetColumnVis( iCol, bVis ? false : true );
    }
    $.fn.dataTableExt.oApi.fnGetColumnIndex = function ( oSettings, sCol )
    {
	var cols = oSettings.aoColumns;
	for ( var x=0, xLen=cols.length ; x<xLen ; x++ )
	{
	    if ( cols[x].sTitle.toLowerCase() == sCol.toLowerCase() )
	    {
		return x;
	    };
	}
	return -1;
    }
    $(document).ready(function() {
	tbl = $('#two').dataTable({
	    //"bJQueryUI": true,
	    "sPaginationType": "full_numbers",
	    //"bPaginate": false
	    "iDisplayLength": 15,
	    "sScrollX": "100",
	    //"sScrollXInner": "110%",
	    "bScrollCollapse": true
	});

	$('#one input').not(':checked').each(function(){
	    val = tbl.fnGetColumnIndex(this.name);
	    if(val != -1)
		tbl.fnSetColumnVis(val, false );
	    //console.log(this.name, tbl);
	});
    } );
</script>
<style>
    .tlist
    {
        border-width: 1px;
        border-spacing: 0px;
        border-style: hidden;
        border-color: gray;
        border-collapse: collapse;
        background-color: white;
    }
    .tlist td
    {
        border-width: 1px;
        padding: 5px;
        border-style: inset;
        border-color: gray;
        background-color: white;
    }
</style>

<h5>Users List</h5>
<hr>
<br/>

What columns do you want to see?
<table class="tlist" id="one">
    <tr>
        <td>
            <input type="checkbox" name="ID" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"/> ID
            <br>
            <input type="checkbox" name="Edit" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" checked="checked"/> Edit
            <br>
            <input type="checkbox" name="Last Login" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"/> Last
        </td>
        <td>
            <input type="checkbox" name="First Last" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" checked="checked"/> First Last
            <br>
            <input type="checkbox" name="Last Name" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"/> Last Name
            <br>
            <input type="checkbox" name="First Name" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"/> First Name
        </td>
        <td>
            <input type="checkbox" name="Email" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"  checked="checked"/> Email
            <br>
            <input type="checkbox" name="SMS" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"/> SMS
            <br>
            <input type="checkbox" name="Type" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"  checked="checked"/> Type
        </td>
        <td>
            <input type="checkbox" name="Home Phone" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));"/> Home Phone
            <br>
            <input type="checkbox" name="Cell Phone" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" /> Cell Phone
            <br>
            <input type="checkbox" name="Address" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" /> Address

        </td>
        <td>
            <input type="checkbox" name="Profile" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" /> Profile
            <br>
            <input type="checkbox" name="Account" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" /> Account
            <br>
            <input type="checkbox" name="EContact" onclick="fnShowHide(tbl.fnGetColumnIndex($(this).attr('name')));" /> EContact
        </td>
    </tr>
</table>
<table width="100%" class="display" id="two">
    <thead>
	<tr>
	    <th>Last Login</th>
	    <th>ID</th>
	    <th>Edit</th>
	    <th>First Last</th>
	    <th>Last Name</th>
	    <th>First Name</th>
	    <th>Email </th>
	    <th>SMS</th>
	    <th>Type</th>
	    <th>Home Phone</th>
	    <th>Cell Phone</th>
	    <th>Address</th>
	    <th>Profile</th>
	    <th>Account</th>
	    <th>EContact</th>
	</tr>
    </thead>
    <tbody>
	<?php
	foreach ($users as $row) {

	    echo "<tr>\n";
	    echo "<td> " . $row["last_login"] . "</td>\n";
	    echo "<td> " . $row["id"] . "</td>\n";
	    echo "<td> " . anchor("admin/user_edit/" . $row["id"], "Edit") . "</td>\n";
	    echo "<td> " . $row["firstname"] . " " . $row["lastname"] . "</td>\n";
	    echo "<td> " . $row["lastname"] . "</td>\n";
	    echo "<td> " . $row["firstname"] . "</td>\n";
	    echo "<td> " . $row["email"] . "</td>\n";
	    echo "<td> " . $row["sms"] . "</td>\n";
	    echo "<td> " . $row["type"] . "</td>\n";
	    echo "<td> " . $row["homephone"] . "</td>\n";
	    echo "<td> " . $row["cellphone"] . "</td>\n";
	    echo "<td> " . $row["mailaddress"] . "</td>\n";

	    if ($row["web_state"] == 'incomplete')
		$row["web_state"] = "<strong>" . $row["web_state"] . "</strong>";
	    echo "<td> " . $row["web_state"] . "</td>\n";

	    if ($row["account_complete"])
		$ac = "complete";
	    else
		$ac = "<strong>incomplete</strong>";
	    echo "<td class=\"ac\"> " . $ac . "</td>\n";

	    if ($row["econtact_complete"] == true)
		$ec = "complete";
	    elseif ($row["econtact_complete"] == false)
		$ec = "<strong>incomplete</strong>";
	    else
		$ec = "Error";

	    echo "<td class=\"ec\"> " . $ec . "</td>\n";


	    echo "</tr>\n";

	    //print_r($row);
	}
	?>
    </tbody>
</table>
<div class="clear"></div>


