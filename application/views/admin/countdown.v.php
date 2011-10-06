<h5> Login page Countdown </h5>
<hr>



<?php

function form_labelb($text, $for)
{
    return form_label($text, $for);
}

    echo form_open("admin/io");

    echo form_labelb("Line 1: ", 'line1');
    echo form_input("line1", $line1);
    echo "[countdown]";
    echo form_input("line2", $line2, 'style="width: 100%"');
    echo form_input("event", $event, 'style="width: 100%"');

    echo "<br><br><hr><br>";

    echo form_input("fm1", $fm1, 'style="width: 100%"');
    echo "[event]";
    echo form_input("fm2", $fm2, 'style="width: 100%"');
    echo form_input("date", $date, 'style="width: 100%"');



/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//	
//	echo form_hidden("name", "countdown");
//	//echo form_input("value1", $line1, 'style="width: 100%"');
//	echo form_input("value", $current, 'style="width: 100%"');
//	//echo form_input("value3", $line2, 'style="width: 100%"');
//	//echo $current;
//	echo "<br><br>";
//	echo form_hidden("to", "/admin/countdown");
//	echo form_hidden("msg", "Countdown Date Successfully Updated");
//	echo form_submit("update","Update");
?>
