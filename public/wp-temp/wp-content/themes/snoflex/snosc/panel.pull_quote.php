<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	$photo_id = null;
	?>
	<div class="wrap container snosc-panel" id="snosc-pull-quote">
		<h2>Pull Quote</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td colspan=2>
						<b>Speaker</b><br>
						<input type="input" id="snosc-pull-quote-speaker" size="40">
					</td>
				</tr>

				<tr valign="top">
					<td colspan=2>
						<b>Pull Quote</b><br>
						<input type="input" id="snosc-pull-quote-quote" size="40">
					</td>
				</tr>

				<tr valign="top" style="height: 120px; min-height: 120px">
					<td>

						<table><tr><td>
							<b><input class="snosc-input" id="upload-snosc-pull-quote-photo" class="button" type="button" value="Add Photo" /></b>
							
						</td><td>

						<b>Current Photo</b><br>
						<input id="snosc-pull-quote-photo-id" type="hidden" size="36" name="snosc-pull-quote-photo-id" value="" /> 
						<div id="snosc-pull-quote-photo"></div>
					</td></tr></table>

				</td>
			</tr>

			<?php sno_emit_snosc_common_fields('snosc-pull-quote'); ?>
			
		</table>

		<button href="#" id="insert-snosc-pull-quote" class="button btn btn-warning">Insert Pull Quote</button>

	</form>

</div>
<script>
jQuery(function($) {
	$(document).ready(function(){

		$('#insert-snosc-pull-quote').click(function(event) {
			event.preventDefault();

			var speaker=$("#snosc-pull-quote-speaker").val();
			var quote=$("#snosc-pull-quote-quote").val();
			var photo=$("#snosc-pull-quote-photo-id").val();
			var alignment=$("#snosc-pull-quote-alignment").val();
			var background=$("#snosc-pull-quote-background").val();
			var border=$("#snosc-pull-quote-border").val();
			var shadow=$("#snosc-pull-quote-shadow").val();

			$("#snosc-pull-quote-speaker").val("");
			$("#snosc-pull-quote-quote").val("");
			$("#snosc-pull-quote-photo-id").val("");
		//	$("#snosc-pull-quote-alignment").val("");
		//	$("#snosc-pull-quote-background").val("");
		//	$("#snosc-pull-quote-border").val("");
		//	$("#snosc-pull-quote-shadow").val("");

			wp.media.editor.insert('[pullquote speaker="' + speaker + '" photo="' + photo + '" align="' + alignment + '" background="' + background + '" border="' + border + '" shadow="' + shadow + '"]'+quote+'[/pullquote]');
		});

	});
});
</script>

<script>
jQuery(document).ready(function($){

	var custom_uploader;

	$('#upload-snosc-pull-quote-photo').click(function(e) {

		e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
        	custom_uploader.open();
        	return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
        	title: 'Choose Image',
        	button: {
        		text: 'Choose Image'
        	},
        	multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
        	console.log(custom_uploader.state().get('selection').toJSON());
        	attachment = custom_uploader.state().get('selection').first().toJSON();
          //  alert(JSON.stringify(attachment.sizes.thumbnail));
          $('#snosc-pull-quote-photo-url').val(attachment.url);
          $('#snosc-pull-quote-photo-id').val(attachment.id);
          $('#snosc-pull-quote-photo').html('<img src="'+attachment.sizes.thumbnail.url+'">');
      });

        //Open the uploader dialog
        custom_uploader.open();

    });


});

</script>

<?php
}

