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
	<div class="wrap container snosc-panel" id="snosc-sports-standings">
		<h2>Sports Standings</h2>

		<form method="post" enctype="multipart/form-data">
			<table class="form-table">
			<!--
				<tr valign="top">
					<td colspan=4>
						<b>Title</b><br>
						<input type="input" id="snosc-sports-standings-title" size="40">
					</td>
				</tr>
			-->
				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-sports-standings-sport">
							<?php foreach($sport_list as $sport):
							echo '<option value="'.$sport.'">'.$sport."\n";  
							endforeach; ?>
						</select>
						<b>Select a Sport</b>
					</td>
				</tr>

				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-sports-standings-season">
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

				<tr valign="top">
					<td>
						<select class="snosc-input" id="snosc-sports-standings-type-of-standings">
							<option value="conference">Conference</option>
							<option value="playoff">Playoff</option>
							<option value="staterank">State Rank</option>
						</select>
						<b>Type of Standings</b>
					</td>
				</tr>

				<?php sno_emit_snosc_common_fields('snosc-sports-standings'); ?>

			</table>

			<button href="#" id="insert-snosc-sports-standings" class="button btn btn-warning">Insert Sports Standings</button>

		</form>

	</div>
	<script>
	var default_schoolyear=<?php echo $default_schoolyear; ?>;

	jQuery(function($) {
		$(document).ready(function(){

			$('#insert-snosc-sports-standings').click(function(event) {
				event.preventDefault();

				var sport=$("#snosc-sports-standings-sport").val();
				var season=$("#snosc-sports-standings-season").val();
				var type_of_standings=$("#snosc-sports-standings-type-of-standings").val();
				var alignment=$("#snosc-sports-standings-alignment").val();
				var background=$("#snosc-sports-standings-background").val();
				var border=$("#snosc-sports-standings-border").val();
				var shadow=$("#snosc-sports-standings-shadow").val();
				
			//	$("#snosc-sports-standings-sport").val("");
			//	$("#snosc-sports-standings-type-of-standings").val("");
			//	$("#snosc-sports-standings-season").val(default_schoolyear);
			//	$("#snosc-sports-standings-alignment").val("");
			//	$("#snosc-sports-standings-background").val("");
			//	$("#snosc-sports-standings-border").val("");
			//	$("#snosc-sports-standings-shadow").val("");
				
				wp.media.editor.insert('[standings sport="' + sport + '" season="' + season + '" align="' + alignment + '" type="' + type_of_standings + '" background="' + background + '" border="' + border + '" shadow="' + shadow + '"]');
			});

		});
	});
	</script>
	<?php
}

