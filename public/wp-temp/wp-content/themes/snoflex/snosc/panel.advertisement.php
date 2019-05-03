<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	$ad_group_list = sno_ad_group_list();
	?>
	<div class="wrap container snosc-panel" id="snosc-advertisement">
		<h2>Advertisement</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td>
						<select class="snosc-input-m" id="snosc-advertisement-group">
							<?php foreach($ad_group_list as $id=>$group):
							echo '<option value="'.$id.'">'.$group; 
							endforeach; ?>
						</select>
						<b>Select an Ad Group</b>
					</td>
				</tr>

				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-advertisement-alignment">
							<option value="left"<?php if (get_theme_mod('story-element-align') == 'left') echo ' selected="selected"'; ?>>Left</option>
							<option value="right"<?php if (get_theme_mod('story-element-align') == 'right') echo ' selected="selected"'; ?>>Right</option>
							<option value="center"<?php if (get_theme_mod('story-element-align') == 'center') echo ' selected="selected"'; ?>>Center</option>
						</select>
						<b>Alignment</b>
					</td>
				</tr>
	<!--
				<tr valign="top">
					<td>
						<select  class="snosc-input" name="snosc-advertisement-background" id="snosc-advertisement-background">
							<option value="on">On</option>
							<option value="off">Off</option>
						</select>
						<b>Background</b>
					</td>

					<td>
						<select class="snosc-input"  name="snosc-advertisement-shadow" id="snosc-advertisement-shadow">
							<option value="on">On</option>
							<option value="off">Off</option>
						</select>
						<b>Shadow</b>
					</td>
				</tr>
	-->
			</table>

			<button href="#" id="insert-snosc-advertisement" class="button btn btn-warning">Insert Advertisement</button>

		</form>

	</div>
	<script>
	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-advertisement').click(function(event) {
				event.preventDefault();

				var group=$("#snosc-advertisement-group").val();
				var alignment=$("#snosc-advertisement-alignment").val();
			//	var background=$("#snosc-advertisement-background").val();
			//	var shadow=$("#snosc-advertisement-shadow").val();

				$("#snosc-advertisement-group").val("");
			//	$("#snosc-advertisement-alignment").val("");
			//	$("#snosc-advertisement-background").val("");
			//	$("#snosc-advertisement-shadow").val("");

				wp.media.editor.insert('[snoadrotate_group group_ids="' + group + '" align="' + alignment + '"]');
			});

		});
	});
	</script>
	<?php
}
