<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	?>
	<div class="wrap container snosc-panel" id="snosc-audio-clip">
		<h2>Audio Clip</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td colspan=4>
						<b>Audo Embed Code</b><br>
						<input type="input" id="snosc-audio-clip-code" size="60" placeholder="">
					</td>
				</tr>
		<!--
				<tr valign="top">
					<td colspan=4>
						<b>Credit</b><br>
						<input type="input" id="snosc-audio-clip-credit" size="60">
					</td>
				</tr>
		-->
				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-audio-clip-alignment">
							<option value="left"<?php if (get_theme_mod('story-element-align') == 'left') echo ' selected="selected"'; ?>>Left</option>
							<option value="right"<?php if (get_theme_mod('story-element-align') == 'right') echo ' selected="selected"'; ?>>Right</option>
							<option value="center"<?php if (get_theme_mod('story-element-align') == 'center') echo ' selected="selected"'; ?>>Center</option>
						</select>
						<b>Alignment</b>
					</td>
				</tr>

			</table>

			<button href="#" id="insert-snosc-audio-clip" class="button btn btn-warning">Insert Audio Clip</button>

		</form>

	</div>
	<script>
	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-audio-clip').click(function(event) {
				event.preventDefault();

				var code=$("#snosc-audio-clip-code").val();
			//	var credit=$("#snosc-audio-clip-credit").val();
				var alignment=$("#snosc-audio-clip-alignment").val();
				
				$("#snosc-audio-clip-code").val("");
			//	$("#snosc-audio-clip-credit").val("");
			//	$("#snosc-audio-clip-alignment").val("");
				
				wp.media.editor.insert('[audioclip align="' + alignment + '"]'+code+'[/audioclip]');
			});

		});
	});
	</script>
	<?php
}
