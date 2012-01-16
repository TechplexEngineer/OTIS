<h5> Edit Blog Entry</h5>
<hr><br>
<!--<script type="text/javascript" src="js/jscripts/tiny_mce/jquery.tinymce.js"></script>-->

<script type="text/javascript" src="<?php echo MEDIAPATH; ?>js/tiny_mce/tiny_mce.js"></script>

<!--<script type="text/javascript">

  tinyMCE.init({
    mode : "exact",
    theme : "advanced",
    relative_urls : false,
    document_base_url : "/",
    language : "en",
    safari_warning : true,
    entity_encoding : "raw",
    verify_html : false,
    preformatted : true,
    convert_fonts_to_spans : true,
    remove_linebreaks : false,
    apply_source_formatting : true,
    theme_advanced_resize_horizontal : false,
    theme_advanced_resizing_use_cookie : false,
    plugins : "advimage,advlink,contextmenu,fullscreen,searchreplace,style,table",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_path_location : "bottom",
    theme_advanced_resizing : true,
    theme_advanced_blockformats : "p,address,pre,h1,h2,h3,h4,h5,h6",
    theme_advanced_buttons1 : "bold,italic,underline,separator,link,unlink,separator,image,charmap,separator,code",
    theme_advanced_buttons2 : "formatselect,fontsizeselect,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,indent,outdent",
    theme_advanced_buttons3 : "cleanup,forecolor,backcolor,hr,replace,visualaid,fullscreen,styleprops,tablecontrols",
    extended_valid_elements : "img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],a[name|href|target|title|onclick]",
    elements : "edit-body"
  });

</script>-->

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<script type="text/javascript">
    /*$().ready(function() {
        $('textarea.tinymce').tinymce({
            // Location of TinyMCE script
            script_url : '/application/media/js/jscripts/tiny_mce/tiny_mce.js',

            // General options
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleprops,styleselect,formatselect,fontselect,fontsizeselect,visualchars,nonbreaking,|,fullscreen",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,search,|,bullist,numlist,|,outdent,indent,|,cite,abbr,acronym,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,|,ltr,rtl,insertlayer,moveforward,movebackward,absolute,flash,media",
            theme_advanced_buttons4 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

	    //cleanup : false,

            // Example content CSS (should be your site CSS)
            content_css : "http://team2648.com/sites/team2648.com/themes/zen_midnight/zen_midnight.css"
        });
    });*/

</script>
<?php echo form_open('/blog/admin/update/'.$bid); ?>
<!--<form id="blogEntry" method="post" action="">-->
<input type="hidden" name="timestamp" value="<?php echo date('m/d/y@g:i:s'); ?>"/>
<input type="hidden" name="bid" value="<?php echo $bid ?>"/>

Title: &nbsp; <input type="text" name="title" style="width: 35%;" value="<?php echo $btitle; ?>"/>
<br/>
<br/>
Date of event: &nbsp; <input type="text" name="eventDate" value="<?php echo $date; ?>"/>
<br/>
<br/>
<a href="javascript:;" onmousedown="tinyMCE.get('elm1').hide();">[Hide]</a> <a href="javascript:;" onmousedown="tinyMCE.get('elm1').show();">[Show]</a><br>
<textarea name="entry" rows="15" cols="80" id="elm1" class="tinymce form-textarea"><?php echo $entry; ?></textarea>
<br/>
<br/>
Author: &nbsp; <input type="text" name="author" value="<?php echo $author; ?>"/>
<br>
<input type="submit" name="action" value="Update" />
<input type="submit" name="action" value="Update & Approve" />
<input type="submit" name="action" value="Update & UnApprove" />
<input type="submit" name="action" value="Delete" />
</form>