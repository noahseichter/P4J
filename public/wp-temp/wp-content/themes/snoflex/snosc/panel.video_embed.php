<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	?>
	<div class="wrap container snosc-panel" id="snosc-video-embed">
		<h2>Video Embed</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td colspan=4>
						<b>Video Embed Code</b><br>
						<input type="input" id="snosc-video-embed-code" size="60" placeholder="">
					</td>
				</tr>

				<tr valign="top">
					<td colspan=4>
						<b>Credit</b><br>
						<input type="input" id="snosc-video-embed-credit" size="60">
					</td>
				</tr>
				
				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-video-embed-alignment">
							<option value="left"<?php if (get_theme_mod('story-element-align') == 'left') echo ' selected="selected"'; ?>>Left</option>
							<option value="right"<?php if (get_theme_mod('story-element-align') == 'right') echo ' selected="selected"'; ?>>Right</option>
							<option value="center"<?php if (get_theme_mod('story-element-align') == 'center') echo ' selected="selected"'; ?>>Center</option>
						</select>
						<b>Alignment</b>
					</td>
				</tr>

			</table>

			<button href="#" id="insert-snosc-video-embed" class="button btn btn-warning">Insert Video Embed</button>

		</form>

	</div>
	<script>
	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-video-embed').click(function(event) {
				event.preventDefault();

				var code=$("#snosc-video-embed-code").val();
				var credit=$("#snosc-video-embed-credit").val();
				var alignment=$("#snosc-video-embed-alignment").val();

				$("#snosc-video-embed-code").val("");
				$("#snosc-video-embed-credit").val("");
			//	$("#snosc-video-embed-alignment").val("");

				wp.media.editor.insert('[video credit="' + credit + '" align="' + alignment + '"]'+code+'[/video]');
			});

		});
	});
	</script>
	<?php
}
