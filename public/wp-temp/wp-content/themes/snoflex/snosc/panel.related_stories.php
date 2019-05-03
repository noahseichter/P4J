<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/
{
	?>
	<div class="wrap container snosc-panel" id="snosc-related-stories">
		<h2>Related Stories</h2>
		
		<form method="post" enctype="multipart/form-data">
			<table class="form-table">

				<tr valign="top">
					<td colspan=2>
						<b>Title</b><br>
						<input type="search" id="snosc-related-stories-title" size="40" placeholder="Related Stories" value="Related Stories">
					</td>
				</tr>

				<tr valign="top">
					<td class="snosc-cell-left snosc">
						<b>Search for Stories</b><br>
						<input class="snosc-input-50" type="input" id="snosc-related-stories-autocomplete" size="20" placeholder="Enter Keyword from Title"><br>
					</td>
					<td class="snosc-cell-right">
						<b>Selected Stories</b>
						<div id="snosc-related-stories-selected-stories"></div>
					</td>
				</tr>

				<tr valign="top">
					<td colspan=2>
					</td>
				</tr>

				<?php sno_emit_snosc_common_fields('snosc-related-stories'); ?>
				
			</table>

			<button href="#" id="insert-snosc-related-stories" class="button btn btn-warning">Insert Related Stories</button>

		</form>

	</div>
	<script>
	var stories=[];
	var ac_allow_close=true;
	</script>
	<script>
	jQuery(function($) {
		$(document).ready(function(){

			function snosc_isNumeric(n) {
				return !isNaN(parseFloat(n)) && isFinite(n);
			}

			$('#insert-snosc-related-stories').click(function(event) {
				event.preventDefault();

				var story_ids=[];
				for(var i=0;i<=stories.length-1;i++)
				{
					var obj=stories[i];
					story_ids.push(obj.id);
				}

				var title=$("#snosc-related-stories-title").val();
				var alignment=$("#snosc-related-stories-alignment").val();
				var background=$("#snosc-related-stories-background").val();
				var border=$("#snosc-related-stories-border").val();
				var shadow=$("#snosc-related-stories-shadow").val();

				$("#snosc-related-stories-title").val();
			//	$("#snosc-related-stories-alignment").val("");
			//	$("#snosc-related-stories-background").val("");
			//	$("#snosc-related-stories-border").val("");
			//	$("#snosc-related-stories-shadow").val("");
				stories=[];

				wp.media.editor.insert('[related title="' + title + '" stories="' + story_ids + '" align="' + alignment + '" background="' + background + '" border="' + border + '" shadow="' + shadow + '"]');
			});

		});
});
</script>
<script>
jQuery(function($) {
	$(document).ready(function(){

		$( "#snosc-related-stories-select" ).change(function(event) {
			event.preventDefault();
			snosc_render_stories($);
		})
	})

});

function snosc_link_clicks($,obj_id)
{
	/* add */
	$('.snosc-selected-add').on("change",function(event) {
		event.preventDefault();

		var id=$(this).attr("value");
		var title=$(this).data("title");

		snosc_stories_add(id,title);

		console.log(".snosc-selected-add "+id);

		snosc_render_stories($);
	});

	/* delete */
	$('#snosc-related-stories-selected-stories a').on("click",function(event) {
		event.preventDefault();

		var id=$(this).data("id");

		console.log("#snosc-related-stories-selected-stories a delete "+id);

		snosc_stories_delete(id);
		snosc_render_stories($);
	});

	/*
	$('.snosc-selected-delete').on("click",function(event) {
		event.preventDefault();

		var id=$(this).data("id");

		console.log('.snosc-selected-delete '+id);

		snosc_stories_delete(id);
		snosc_render_stories($);
	});

	if(typeof(obj_id)!=undefined)
	{
		$('#snosc-selected-delete-'+obj_id).on("click",function(event) {
			event.preventDefault();

			var id=$(this).data("id");

			console.log('#snosc-selected-delete-'+obj_id);

			snosc_stories_delete(id);
			snosc_render_stories($);
		});
	}

	$('#snosc-selected-delete').on("click",function(event) {
		event.preventDefault();

		var id=$(this).data("id");

		console.log('#snosc-selected-delete '+id);

		snosc_stories_delete(id);
		snosc_render_stories($);
	});
*/

}
</script>

<script>
jQuery(function($) {
	$(document).ready(function(){

		snosc_related_stories_autocomplete($);

	});

});

/* */
function snosc_related_stories_autocomplete($)
{
	ac_allow_close=false;
	var ac = $("#snosc-related-stories-autocomplete").autocomplete({
		autoFocus: true,

		source: function( request, response) {
			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				dataType: "json",
				data: {
					action: "related_stories",
					q: request.term,
					max_length: 46
				},
				success: function( data ) {
					response( data );
				}
			});
		},  

		minLength: 0,

		blur: function() {
			ac_allow_close=true;
		},

		focus: function() {
			return false;
		},

		select: function(event, ui) {
			/* add */
			event.preventDefault();

			var a=ui.item.value.split("\t");
			var id=a[0];
			var title=a[1];
			if(snosc_stories_add(id,title))
				$('#snosc-related-stories-add-'+id).prop('checked',true);

			snosc_render_stories($);

			if(!ac_allow_close) return;

			/* */
			if (event.keyCode == 13) {
				document.getElementById("snosc-related-stories-autocomplete").value = document.getElementById("snosc-related-stories-autocomplete").value;
			} else if (event.keyCode == 27) {
				$("snosc-related-stories-autocomplete").autocomplete("close"); 
			}

			/* */
			setTimeout(snosc_related_stories_autocomplete($), 100);

			return false;
		},

		html: true, 

		open: function(event, ui) {
			event.preventDefault();
		},

		close: function(event, ui) {
			if(!ac_allow_close) return;

			event.preventDefault();
			document.getElementById("snosc-related-stories-autocomplete").value = "";
			return false;
		}
	});

/* render each line of the autocomplete dropdown */
ac.data("ui-autocomplete")._renderItem = function (ul, item) {
	var a=item.value.split("\t");
	var id=a[0];
	var title=a[1];

	var checked='';
	for(var i=0;i<=stories.length-1;i++)
	{
		var obj=stories[i];
		if(parseInt(obj.id)==parseInt(id)) { checked=' checked'; break; }
	}

	var htmlline='<input'+checked+' class="snosc-related-stories-add" type="checkbox" name="snosc-related-stories-add-'+id+'" id="snosc-related-stories-add-'+id+'" value="'+id+'" data-title="'+title+'">'+title;

	return $("<li></li>") 
	.data("item.ui-autocomplete", item)
	.append(htmlline)
	.appendTo(ul);
};
/* override autocomplete .selected to keep focus, not close the ac */

ac.data("ui-autocomplete").menu.options.select = function(event, ui) { 
	if(!ac_allow_close) return;

	var item = ui.item.data( "item.ui-autocomplete" );
	ac.focus();
	return false;
};
ac.data("uiAutocomplete").close = function(event, ui) { 
	if(ac_allow_close)
	{
		clearTimeout(this.closing), this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.deactivate(), this._trigger("close", e));
		return;
	}
	else
		return false;
};

$("#snosc-related-stories-autocomplete").on("blur",function() {
	ac_allow_close=true;
	ac.data("uiAutocomplete").select=null;
	ac.data("uiAutocomplete").close=null;
	$(".ui-autocomplete").html("");
	$(".ui-autocomplete").hide();
	$("#snosc-related-stories-autocomplete").val("");
});

}

/* draw the list of stories on the right */
function snosc_render_stories($)
{
	var str="";
	for(var i=0;i<=stories.length-1;i++)
	{
		var obj=stories[i];
		str += '<a class="snosc-selected-delete" id="snosc-selected-delete-'+obj.id+'" data-id="'+obj.id+'">' + obj.title + '<span class="dashicons dashicons-no"></span></a>';
	}
	$( "#snosc-related-stories-selected-stories" ).html( str );
	setTimeout(snosc_link_clicks($), 100);
}

/* */
var MAX_STORIES=4;
function snosc_stories_add(id,title)
{
	/* */
	if(stories.length>=MAX_STORIES) return false;

	/* check for duplicates first */
	for(var i=0;i<stories.length;i++)
	{
		var obj=stories[i];
		if(parseInt(obj.id)==parseInt(id)) return false;
	}

	/* add story to list */
	var obj={id: id, title: title};
	stories.push(obj);

	return true;
}

/* */
function snosc_stories_delete(id)
{
	for(var i=0;i<stories.length;i++)
	{
		var obj=stories[i];
		if(parseInt(obj.id)==parseInt(id))
		{
			stories.splice(i,1);
			break;
		}
	}
}
</script>

<style>
.snosc-input-50 {
	min-width: 90%;
	max-width: 90%;
	width: 90%;
	margin-right: 1em !important;
}
.snosc-input-50 option {
	min-width: 100%;
	max-width: 100%; 
	width: 100%; 
	margin-right: 1em !important;
}
.snosc-cell-left { 
	max-width: 60%;
	width: 60%; 
	vertical-align: top !important; 
}	
.snosc-cell-right { 
	max-width: 40%; 
	width: 40%;
	vertical-align: top !important;
}
a.snosc-selected-delete { 
	display: block !important;
	width: 100%;
	padding: 4px 4px 4px 8px;
	margin: 6px 6px 6px 0px; 
	background-color: #444;
	color: white;
	clear: both;
}
a:hover.snosc-selected-delete { 
	color: <?php echo get_theme_mod('accentcolor1-text-hover'); ?>;
}
a.snosc-selected-delete span { float: right;}
.snosc {}
.ui-menu-item {overflow-x: hidden;}
.ui-autocomplete {
	position: relative;
	top: 0;
	left: 0;
	z-index: 1000060;
	float: left;
	display: block;
	min-width: 160px;
	width: 160px;
	padding: 4px 0;
	margin: 2px 0 0 0;
	list-style: none;
	background-color: #ffffff;
	border-color: #ccc;
	border-color: rgba(0, 0, 0, 0.2);
	border-style: solid;
	border-width: 1px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	*border-right-width: 2px;
	*border-bottom-width: 2px;

	.ui-menu-item > a.ui-corner-all {
		display: block;
		padding: 3px 15px;
		clear: both;
		font-weight: normal;
		line-height: 18px;
		color: #555555;
		white-space: nowrap;

		&.ui-state-hover, &.ui-state-active {
			color: #ffffff;
			text-decoration: none;
			background-color: #0088cc;
			border-radius: 0px;
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			background-image: none;
		}
	}
}
.snosc-cell-left input, .snosc-cell-right, .ui-autocomplete {
	font-size: .8em !important;
}

</style>
<?php
}

