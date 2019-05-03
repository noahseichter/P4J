<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
if(get_option('ssno') == SPORTS_SSNO)
{
	$sport_list = sno_sport_list();
	$sport_schoolyear_list=sno_sport_schoolyear_list();
	?>
	<div class="wrap container snosc-panel" id="snosc-sports-roster">
		<h2>Sports Roster</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">
		<!--
				<tr valign="top">
					<td colspan=4>
						<b>Title</b><br>
						<input type="input" id="snosc-sports-roster-title" size="40">
					</td>
				</tr>
		-->
				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-sports-roster-sport">
							<?php foreach($sport_list as $sport):
							echo '<option value="'.$sport.'">'.$sport."\n"; 
							endforeach; ?>
						</select>
						<b>Select a Sport</b>
					</td>
				</tr>

				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-sports-roster-season">
							<?php 
							$default_schoolyear=sno_get_current_sports_schoolyear();
							foreach($sport_schoolyear_list as $year):

								$season=$year.'-'.($year+1);
							echo '<option value="'.$season.'"';
							if($season==$default_schoolyear) echo ' selected';
							echo '>'.$season."\n";

							endforeach; ?>
						</select>
						<b>Select a Season</b>
					</td>
				</tr>

				<?php sno_emit_snosc_common_fields('snosc-sports-roster'); ?>

			</table>

			<button href="#" id="insert-snosc-sports-roster" class="button btn btn-warning">Insert Sports Roster</button>

		</form>

	</div>

	<script>
	var default_schoolyear=<?php echo $default_schoolyear; ?>;

	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-sports-roster').click(function(event) {
				event.preventDefault();

				var sport=$("#snosc-sports-roster-sport").val();
				var season=$("#snosc-sports-roster-season").val();
				var alignment=$("#snosc-sports-roster-alignment").val();
				var background=$("#snosc-sports-roster-background").val();
				var border=$("#snosc-sports-roster-border").val();
				var shadow=$("#snosc-sports-roster-shadow").val();

			//	$("#snosc-sports-schedule-sport").val("");
			//	$("#snosc-sports-schedule-season").val(default_schoolyear);
			//	$("#snosc-sports-schedule-alignment").val("");
			//	$("#snosc-sports-schedule-background").val("");
			//	$("#snosc-sports-schedule-border").val("");
			//	$("#snosc-sports-schedule-shadow").val("");
				
				wp.media.editor.insert('[roster sport="' + sport + '" season="' + season + '" align="' + alignment + '" background="' + background + '" border="' + border + '" shadow="' + shadow + '"]');
			});

		});
	});
	</script>
	<?php
}
