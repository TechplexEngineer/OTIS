<script src="<?php echo MEDIAPATH; ?>js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo MEDIAPATH; ?>js/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo MEDIAPATH; ?>js/jquery.autofocus-min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo MEDIAPATH; ?>css/jq/jquery.ui.all.css">
<script type="text/javascript" src="<?php echo MEDIAPATH; ?>js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo MEDIAPATH; ?>js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo MEDIAPATH; ?>js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo MEDIAPATH; ?>js/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo MEDIAPATH; ?>js/ui/jquery.ui.autocomplete.js"></script>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<script type=\"text/javascript\" src=\"".MEDIAPATH."js/counter/counter.js\"></script>";
echo form_open('/admin/sms_send');
$bfig = $this->config->item('bfig');
?>
<script type="text/javascript">
    $(function() {

        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }

        $.get("http://otis.team2648.com/data/sms",{ action: "sms"}, function(data){
            smsaddresses = data.split("/");
            smsCSV = smsaddresses.join(", ")
            document.getElementById('smsaddyhidden').innerHTML= "<input type=\"hidden\" value=\""+smsCSV+"\" name=\"smsCSV\" />";
        });
        //<input type=\"hidden\" value=\""+smsCSV+"\" name=\"smsCSV\" />

        $( "#smsto" ).autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                response( $.ui.autocomplete.filter(
                smsaddresses, extractLast( request.term ) ) );
            },
            focus: function() {
                // prevent value inserted on focus
                //alert("Junk");
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });
    });
</script>

<fieldset>
    <legend>Send a Text Message</legend>

    <table width="100%">
	<tr>
	    <td>To</td>
	    <td><textarea name="ToText" id="smsto" cols="75" rows="2" onKeyUp="return checkEnable();"> All Team Members, </textarea></td>
	</tr>
	<tr>
	    <td>Subject</td>
	    <td><textarea name="Subject" cols="75" rows="1"></textarea></td>
	</tr>
	<tr>
	    <td>Message</td>
	    <td><textarea name="MessageText" id="MessageText" onKeyUp="return updateCount();" cols="75" rows="15"> lol </textarea></td>
	</tr>
    </table>
    <div id="msg"> Enter at least <script type="text/javascript">document.write(minChars);</script> characters... </div>


    <input type="submit" name="Send" id="send" value=" Send " disabled="true" />
    <div id="smsaddyhidden"></div>
</form>
</fieldset>