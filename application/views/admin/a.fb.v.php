<?php echo form_open('admin/fb_post'); ?>
<div id="fb">

    <h5>Post to Team Facebook Page</h5>
    <hr>
    <br>

    <table width="100%">
        <tr>
            <td style="vertical-align:top;">To:</td>
            <td>
                <textarea name="to" cols="75" readonly="readonly" rows="1">copier492zinc@m.facebook.com</textarea>
            </td>
        </tr>
        <tr>
            <td>Post:</td>
            <td>
                <textarea  name="post" cols="75"rows="5"></textarea>
            </td>
        </tr>
    </table>
</div>

<div id="sendButton1">
    <input type="submit" id="send" name="Send" value="Send" />
</div>
</form>

