<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	?>
	<div class="wrap container snosc-panel" id="snosc-infographic-embed">
		<h2>Infographic Embed</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td colspan=4>
						<b>Infographic Embed Code</b><br>
						<input type="input" id="snosc-infographic-embed-code" size="60" placeholder="">
					</td>
				</tr>

		<!--	<tr valign="top">
					<td colspan=4>
						<b>Credit</b><br>
						<input type="input" id="snosc-infographic-embed-credit" size="60">
					</td>
				</tr>
		-->
				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-infographic-embed-alignment">
							<option value="left"<?php if (get_theme_mod('story-element-align') == 'left') echo ' selected="selected"'; ?>>Left</option>
							<option value="right"<?php if (get_theme_mod('story-element-align') == 'right') echo ' selected="selected"'; ?>>Right</option>
							<option value="center"<?php if (get_theme_mod('story-element-align') == 'center') echo ' selected="selected"'; ?>>Center</option>
						</select>
						<b>Alignment</b>
					</td>
				</tr>

			</table>

			<button href="#" id="insert-snosc-infographic-embed" class="button btn btn-warning">Insert Infographic Embed</button>

		</form>

	</div>
	<script>
	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-infographic-embed').click(function(event) {
				event.preventDefault();

				var code=$("#snosc-infographic-embed-code").val();
			//	var credit=$("#snosc-infographic-embed-credit").val();
				var alignment=$("#snosc-infographic-embed-alignment").val();

				$("#snosc-infographic-embed-code").val("");
			//	$("#snosc-infographic-embed-credit").val("");
			//	$("#snosc-infographic-embed-alignment").val("");

				wp.media.editor.insert('[infographic align="' + alignment + '"]'+code+'[/infographic]');
			});

		});
	});
	</script>
	<?php
}
