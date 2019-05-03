<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	?>
	<div class="wrap container snosc-panel" id="snosc-sidebar">
		<h2>Side Box</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td colspan=4>
						<b>Title</b><br>
						<input type="input" id="snosc-sidebar-title" size="40">
					</td>
				</tr>

				<tr valign="top">
					<td colspan=4>
						<b>Sidebar Content</b><br>
						<!--a href="#" class="snosc_sidebar_tinymce_toggle">Toggle</a><br-->
						<textarea id="snosc_sidebar_sidebar_content" rows=6></textarea>
					</td>
				</tr>

				<?php sno_emit_snosc_common_fields('snosc-sidebar'); ?>

			</table>

			<button href="#" id="insert-snosc-sidebar" class="button btn btn-warning">Insert Sidebar</button>

		</form>

	</div>
	<?php
	/**
 * NOTES:
 * 
 * Because we have multiple tinymce editors open -- one in the main content editor and one in the popup --
 * the wp media editor insert has issues working as we would like. So we do this manually.
 * We use js to get the cursor position in the #content textarea (The /wp-admin/post.php main text area)
 * and insert the new shortcode html in there via two js functions. Then we call the wp.media.editor
 * insert function as usual with dummy null text to finish the process as normal.
 * 
	**/
	?>
	<script>
	var snosc_sidebar_id="snosc_sidebar_sidebar_content";

	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-sidebar').click(function(event) {
				event.preventDefault();

				var title=$("#snosc-sidebar-title").val();
				var alignment=$("#snosc-sidebar-alignment").val();
				var background=$("#snosc-sidebar-background").val();
				var border=$("#snosc-sidebar-border").val();
				var shadow=$("#snosc-sidebar-shadow").val();

				var sidebar_content=tinyMCE.activeEditor.getContent({format : 'html'});

				if(is_snosc_sidebar_tinymce_visual())
					snosc_sidebar_tinymce_remove();
				tinymce.execCommand('mceFocus',false,'content');

				var shortcode='[sidebar title="' + title + '" align="' + alignment + '" background="' + background + '" border="' + border + '" shadow="' + shadow + '"]'+sidebar_content+'[/sidebar]';

				wp.media.editor.insert(shortcode);

				$("#snosc-sidebar-title").val("");
				$("#snosc_sidebar_sidebar_content").val("");
			//	$("#snosc-sidebar-alignment").val("");
			//	$("#snosc-sidebar-background").val("");
			//	$("#snosc-sidebar-border").val("");
			//	$("#snosc-sidebar-shadow").val("");

				/*	sno_sidebar_tinymce_count++;*/
			});

});
});
</script>
<script>
/*var sno_sidebar_tinymce_count=0;*/
function snosc_sidebar_tinymce_add()
{
	if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) 
	{
		tinyMCE.execCommand('mceAddEditor', true, snosc_sidebar_id);
		tinyMCE.execCommand('mceFocus', true, snosc_sidebar_id);
	}	
}
function snosc_sidebar_tinymce_remove()
{
	if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) 
	{
		tinyMCE.execCommand('mceRemoveEditor', true, snosc_sidebar_id);
	}
}
function snosc_sidebar_tinymce_toggle()
{
	var ed = tinyMCE.get(snosc_sidebar_id);

	if (ed) {
		tinyMCE.execCommand('mceRemoveEditor', true, snosc_sidebar_id);
	} else {
		tinyMCE.execCommand('mceAddEditor', true, snosc_sidebar_id);
	}
}
function is_snosc_sidebar_tinymce_visual()
{
	var ed = tinyMCE.get(snosc_sidebar_id);
	if (ed) {
		return true;
	} else {
		return false;
	}
}
function is_snosc_sidebar_tinymce_text()
{
	var ed = tinyMCE.get(snosc_sidebar_id);
	if (ed) {
		return false;
	} else {
		return true;
	}
}
</script>
<!--script>
	jQuery(function($) {
		$(document).ready(function(){

			$(".snosc_sidebar_tinymce_toggle").on("click",function() {
				event.preventDefault();
				snosc_sidebar_tinymce_toggle();
			});

	});
});
</script-->
<style>
#snosc-sidebar i.mce-i-dfw::before {
	content: "" !important; 
}
</style>
<?php
}
