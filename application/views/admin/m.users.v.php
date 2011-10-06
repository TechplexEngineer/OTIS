<style type="text/css">
    .id{display: none;}
    .fl{display: table-cell;}
    .ln{display: none;}
    .fn{display: none;}
    .em{display: none;}
    .sms{display: none;}
    .ty{display: none;}
    .hp{display: none;}
    .cp{display: none;}
    /*	.me{display: none;}*/
    .ad{display: none;}

    .wp{display: table-cell;}
    .ac{display: table-cell;}
    .ec{display: table-cell;}
    .last{display: table-cell;}
</style>


<script type="text/javascript" src="/application/media/js/sorttable.js"></script>
<script type="text/javascript" src="/application/media/js/zebra.js"></script>


<h5>Users List</h5>
<hr>
<br/>
<style type="text/css" >
    /*	body{
		margin: 64px;
		font-family: "lucida grande", verdana, lucida, sans-serif;
		font-size: 8pt;
	}*/

    table{
        border: 1px solid #666;
    }
    tr td{
        /*		font-family: "lucida grande", verdana, sans-serif;*/
        /*		font-size: 8pt;*/
        padding: 3px 8px;
        background: #fff;
    }
    thead td{
        color: #fff;
        background-color: #C8C028;
        font-weight: bold;
        border-bottom: 1px solid #999;
    }
    tbody td{
        border-left: 1px solid #D9D9D9;
    }
    tbody tr.even td{
        background: #eee;
    }
    tbody tr.selected td{
        background: #3d80df;
        color: #ffffff;
        /*		font-weight: bold;*/
        border-left: 1px solid #346DBE;
        border-bottom: 1px solid #7DAAEA;
    }
    tbody tr.ruled td{
        color: #000;
        background-color: #C6E3FF;
        /*		font-weight: bold;*/
        border-color: #3292FC;
    }

    /* Opera fix */
    head:first-child+body tr.ruled td{
        background-color: #C6E3FF;
    }



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

    table.sortable th
    {
        padding:5px;
    }

</style>
What columns do you want to see?
<table class="tlist omit" id="one">
    <tr>
        <td>
            <input type="checkbox"  onclick="toggleVis2('id', this); "/> ID
            <br>
            <input type="checkbox"  onclick="toggleVis2('edit', this);" checked="checked"/> Edit
            <br>
            <input type="checkbox"  onclick="toggleVis2('last', this);" checked="checked"/> Last
        </td>
        <td>
            <input type="checkbox"  onclick="toggleVis2('fl', this);" checked="checked"/> First Last
            <br>
            <input type="checkbox"  onclick="toggleVis2('ln', this);"/> Last Name
            <br>
            <input type="checkbox"  onclick="toggleVis2('fn', this);"/> First Name
        </td>
        <td>
            <input type="checkbox"  onclick="toggleVis2('em', this);" /> Email
            <br>
            <input type="checkbox"  onclick="toggleVis2('sms', this);"/> SMS
            <br>
            <input type="checkbox"  onclick="toggleVis2('ty', this);"/> Type
        </td>
        <td>
            <input type="checkbox"  onclick="toggleVis2('hp', this);"/> Home Phone
            <br>
            <input type="checkbox"  onclick="toggleVis2('cp', this);"/> Cell Phone
            <br>
            <input type="checkbox"  onclick="toggleVis2('ad', this);"/> Address

        </td>
        <td>
            <input type="checkbox"  onclick="toggleVis2('wp', this);" checked="checked"/> Profile
            <br>
            <input type="checkbox"  onclick="toggleVis2('ac', this);" checked="checked"/> Account
            <br>
            <input type="checkbox"  onclick="toggleVis2('ec', this);" checked="checked"/> Emerg
        </td>
    </tr>
</table>
<!--<input type="submit" value="re-stripe" onclick="stripe();">-->
<table width="100%" class="sortable" id="two">
    <tr>
        <th class="last">lastLogin</th>
        <th class="id">ID</th>
        <th class="edit">Edit</th>
        <th class="fl">First Last</th>
        <th class="ln">Last Name</th>
        <th class="fn">First Name</th>
        <th class="em">Email </th>
        <th class="sms">SMS</th>
        <th class="ty">Type</th>
        <th class="hp">HomePhone</th>
        <th class="cp">CellPhone</th>
        <th class="ad">Address</th>

        <th class="wp">Profile</th>
        <th class="ac">Account</th>
        <th class="ec">EContact</th>
    </tr>

    <?php
    //foreach ($users as $rowa)
    //{
    foreach ($users as $row) {

        echo "<tr>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"last\">" . $row["last_login"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"id\"> " . $row["id"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"edit\">" . anchor("admin/user_edit/" . $row["id"], "Edit") . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"fl\"> " . $row["firstname"] . " " . $row["lastname"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"ln\"> " . $row["lastname"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"fn\"> " . $row["firstname"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"em\"> " . $row["email"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"sms\">" . $row["sms"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"ty\"> " . $row["type"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"hp\"> " . $row["homephone"] . "</td>\n";

        echo "<td style=\"padding:0 5px 0 5px;\" class=\"cp\"> " . $row["cellphone"] . "</td>\n";
//		echo "<td style=\"padding:0 5px 0 5px;\" class=\"me\"> " . $row["medications"] . "</td>\n";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"ad\"> " . $row["mailaddress"] . "</td>\n";
        if ($row["web_state"] == 'incomplete')
            $row["web_state"] = "<strong>" . $row["web_state"] . "</strong>";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"wp\"> " . $row["web_state"] . "</td>\n";

        if ($row["account_complete"])
            $ac = "complete";
        else
            $ac= "<strong>incomplete</strong>";
        echo "<td style=\"padding:0 5px 0 5px;\" class=\"ac\"> " . $ac . "</td>\n";

        if ($row["econtact_complete"] == true)
            $ec = "complete";
        elseif ($row["econtact_complete"] == false)
            $ec = "<strong>incomplete</strong>";
        else
            $ec="Error";

        echo "<td style=\"padding:0 5px 0 5px;\" class=\"ec\"> " . $ec . "</td>\n";


        echo "</tr>\n";

        //print_r($row);
    } ?>

</table>


