<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
if(defined('WP_POLLS_VERSION'))
{
	$reader_poll_list=sno_reader_poll_list();
	?>
	<div class="wrap container snosc-panel" id="snosc-reader-poll">
		<h2>Reader Poll</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td>
						<select class="snosc-input-m" id="snosc-reader-poll-id">
							<?php foreach($reader_poll_list as $poll_id=>$name):
							echo '<option value="'.$poll_id.'"">'.$name; 
							endforeach; ?>
						</select>
						<b>Select a Poll</b>
					</td>
				</tr>

				<?php sno_emit_snosc_common_fields('snosc-reader-poll'); ?>
				
			</table>

			<button href="#" id="insert-snosc-reader-poll" class="button btn btn-warning">Insert Reader Poll</button>

		</form>

	</div>
	<script>
	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-reader-poll').click(function(event) {
				event.preventDefault();

				var id=$("#snosc-reader-poll-id").val();
				var alignment=$("#snosc-reader-poll-alignment").val();
				var background=$("#snosc-reader-poll-background").val();
				var border=$("#snosc-reader-poll-border").val();
				var shadow=$("#snosc-reader-poll-shadow").val();
				
				$("#snosc-reader-poll-id").val("");
			//	$("#snosc-reader-poll-alignment").val("");
			//	$("#snosc-reader-poll-background").val("");
			//	$("#snosc-reader-poll-border").val("");
			//	$("#snosc-reader-poll-shadow").val("");
				
				wp.media.editor.insert('[poll id="' + id + '" align="' + alignment + '" background="' + background + '" border="' + border + '" shadow="' + shadow + '"]');
			});

		});
	});
	</script>
	<?php
}
