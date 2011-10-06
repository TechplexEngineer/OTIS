<?php echo form_open('/admin/vocab/update/'.$new); ?>


<input type="hidden" name="timestamp" value="<?php echo date('m/d/y@g:i:s'); ?>"/>
<!--<input type="hidden" name="bid" value="<?php //echo $bid ?>"/>-->

Word: <br> <input type="text" name="word" style="width: 35%;" value="<?php echo $word; ?>"/>
<br/>
Definition:<br>
<textarea name="def" rows="10" cols="80" ><?php echo $def; ?></textarea>
<br/>
<br/>

<input type="submit" name="action" value="Update" />
</form>


