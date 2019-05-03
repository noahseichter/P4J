/*

SNOSC js for tabbing through media popup

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/

/* */
var snosc_panels=[
'related-stories',
'pull-quote',
'sidebar',
'video-embed',
'infographic-embed',
'audio-clip',
'reader-poll',
'advertisement',
'sports-schedule',
'sports-roster',
'sports-standings'
];

/* startup on page load ... render and populate as needed */
jQuery( document ).ready(function( $ ) {

	if($( "#snosc-tabs" ).length>0) 
	{
		var hash = window.location.hash;
		snosc_switch_tab($,hash);

		$("a.sno-add-sno-story-element").on("click",function(e) {
			e.preventDefault();
			hash=snosc_panels[0];
			snosc_switch_tab($,hash);
			/*if(sno_sidebar_tinymce_count>0)
			{
				snosc_sidebar_tinymce_toggle();
			}*/
		});

		$("#snosc-tabs a").on("click",function(e) {
			e.preventDefault();
			var href = $(this).attr("href");
			snosc_switch_tab($,href);
		});
	}

});

/* handle clicking on settings tabs, switch to different views */
function snosc_switch_tab($,hash)
{
	if($( "#snosc-tabs" ).length==0) return;

	var i=hash.indexOf("#");
	if(!(i==-1))
	{
		hash = hash.substr(i+1);
	}

	var len=snosc_panels.length;
	for(var i=0;i<=len-1;i++)
	{
		$("#snosc-"+snosc_panels[i]).hide();
	}

	var shown=false;
	for(var i=0;i<=len-1;i++)
	{
		if(hash==snosc_panels[i])
		{
			$("#snosc-"+hash).show();
			shown=true;
			break;
		}
	}
	if(!shown)
	{
		$("#snosc-"+snosc_panels[0]).show();
	}

	if(hash=="sidebar")
	{
		snosc_sidebar_tinymce_remove();
		snosc_sidebar_tinymce_add();
	}

}

