<style>
#quicklook1, #quicklook2, #quicklook3, #quicklook4, #quicklook5, #quicklook6, #quicklook7, #quicklook8, #quicklook9 {
    z-index: 110;
	}
#quicklook9 a { background: url(<?php echo bloginfo('template_url') . '/tools/quicklook/close.png'; ?>) no-repeat;padding:5px 10px 10px 35px !important;height:25px;}
span.quickbarright { background: url(<?php echo bloginfo('template_url') . '/tools/quicklook/close.png'; ?>) no-repeat right -1px; float:right; padding-right: 30px; margin-top: -5px;line-height:25px;}
#box1-hover, #box2-hover, #box3-hover, #box4-hover, #box5-hover, #box6-hover, #box7-hover, #box8-hover {
    position: absolute;
    top: 0px;
    right: 0px;
    z-index: 105; 
    height:362px !important;
    width:760px !important;
    display:none;
    background: #ffffff;
    }
#boxwrap {
	position: absolute;
	top: 0px;
	z-index: 105;
    height:362px !important;
    width:980px !important;
    display:none;
    border-bottom:1px solid #aaa;
    }
p.quickcaption {font-size:13px;line-height:17px;margin-top:10px;}
#quicklookphotobox {float:left;margin:0px 10px 0px 0px;}
#quickwrap {position:relative;}
#quicknav ul {list-style: none;}    
#quicknav li {height:27px;width:190px !important;z-index:115;list-style:none;background:#333;color:#fff; padding:12px 10px 0px 20px;border-bottom:1px solid #aaa;font-size:14px;}
#quicknav li:hover {background:#555 !important;}
#quicknav li a { color: #ffffff;}
#quicknav li a:hover { text-decoration:none;}
.quickright {width:740px;float:right;color:#000;padding:10px 10px 0px 10px;}
.quickright h1 {font-size:1.6em;line-height:1.8em;text-shadow:none;margin-top:0px;}
.quickbodytext p {font-size:1.3em; line-height:1.6em; padding:0 0 10px 0;text-transform:none!important;}
.quickbodytext {margin-bottom:10px;}
.quicklookimage {float:right;margin: 0 0 4px 10px;padding:0px;}
.quickbodybottom { border-top:1px solid #d2d2d2;width:760px;height:41px; display:block; background:#f1f1f1; position:absolute; bottom:0; right:0; color:#444;}
.quickbodybottomsecond {width:500px;padding:5px 10px 0px;float:left;height:36px;font-size:14px;}
.quickbodybottomsports {padding:10px 10px 0px;float:left;height:31px;font-size:14px;}
.quickbodybottomsecond:hover {background: #d2d2d2;} 
.quickbodybottommore {width:220px;padding:10px 10px 0px;float:left;height:31px;font-size:14px;background: #e6e6e6;position:absolute;right:0;bottom:0;font-weight:bold;border-left:1px solid #d2d2d2;}
.quickcontinue {float:right;margin:10px 30px 0px 0px;font-size:10px;background:#f1f1f1;border:1px solid #d2d2d2;padding:0px 5px;-moz-border-radius: 4px;border-radius:4px;}
.quickcontinue:hover {background:#d9d9d9;}
a.quickbrlink {position: absolute;bottom:0;right:0;display:block!important;}
.quickbodybottommore:hover {background: #c9c9c9 !important;}
.quickvideoright {width:209px; height:59px;border-bottom:1px solid #fff; float:right;padding:10px 15px;background:#ddd;border-left:1px solid #fff;}
#quickvideomore {width:219px;padding:10px 10px 0px;float:left;height:32px;font-size:14px;background: #bbb;color: #fff; position:absolute;right:0;bottom:0;font-weight:bold;border-left:1px solid #fff;}
#quickvideomore a {color:#000 !important;}
.quickvideowrap {width:519px;height:359px;float:left;border-bottom:1px solid #fff;}
.quickvideoone {width:510px;height:362px;}
.quickvideotitle { background:#fff; width:510px;height:30px; color: #990000; padding:13px 10px 0px 10px; font-size:14px;}
.wrapoverlay { margin:0 auto;display:none;opacity:0.9;width:2000px!important;height:1000px;background:#000000;position:fixed;top:0;left:-500px;z-index:10;}
#menuanchor a { background-color: #eee !important;color:#333!important; }
</style>

<script>
$(document).ready(function() {
    $("#quicklook1").click(function() {
        $("#box1-hover").show();
        $("#box2-hover").hide();
        $("#box3-hover").hide();
        $("#box4-hover").hide();
        $("#box5-hover").hide();
        $("#box6-hover").hide();
        $("#box7-hover").hide();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#777";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook2").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").show();
        $("#box3-hover").hide();
        $("#box4-hover").hide();
        $("#box5-hover").hide();
        $("#box6-hover").hide();
        $("#box7-hover").hide();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#777";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook3").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").hide();
        $("#box3-hover").show();
        $("#box4-hover").hide();
        $("#box5-hover").hide();
        $("#box6-hover").hide();
        $("#box7-hover").hide();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#777";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook4").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").hide();
        $("#box3-hover").hide();
        $("#box4-hover").show();
        $("#box5-hover").hide();
        $("#box6-hover").hide();
        $("#box7-hover").hide();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#777";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook5").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").hide();
        $("#box3-hover").hide();
        $("#box4-hover").hide();
        $("#box5-hover").show();
        $("#box6-hover").hide();
        $("#box7-hover").hide();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#777";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook6").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").hide();
        $("#box3-hover").hide();
        $("#box4-hover").hide();
        $("#box5-hover").hide();
        $("#box6-hover").show();
        $("#box7-hover").hide();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#777";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook7").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").hide();
        $("#box3-hover").hide();
        $("#box4-hover").hide();
        $("#box5-hover").hide();
        $("#box6-hover").hide();
        $("#box7-hover").show();
        $("#box8-hover").hide();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#777";
        document.getElementById("quicklook8").style.backgroundColor="#333";
    });
});
$(document).ready(function() {
    $("#quicklook8").click(function() {
        $("#box1-hover").hide();
        $("#box2-hover").hide();
        $("#box3-hover").hide();
        $("#box4-hover").hide();
        $("#box5-hover").hide();
        $("#box6-hover").hide();
        $("#box7-hover").hide();
        $("#box8-hover").show();
        document.getElementById("quicklook1").style.backgroundColor="#333";
        document.getElementById("quicklook2").style.backgroundColor="#333";
        document.getElementById("quicklook3").style.backgroundColor="#333";
        document.getElementById("quicklook4").style.backgroundColor="#333";
        document.getElementById("quicklook5").style.backgroundColor="#333";
        document.getElementById("quicklook6").style.backgroundColor="#333";
        document.getElementById("quicklook7").style.backgroundColor="#333";
        document.getElementById("quicklook8").style.backgroundColor="#777";
    });
});
$(document).ready(function() {
    $("#quicklook9").click(function() {
        $("#boxwrap").hide('slow');
        $(".wrapoverlay").hide('slow');
        $("#menu-b-menu").show('slow');
        document.getElementById("wrap").style.position="relative";
        document.getElementById("header").style.zIndex="1";
        document.getElementById("menuanchor").style.width="140px";
		document.getElementById('quicklabel').innerHTML ="Quick Look";
		document.getElementById('quicklabel').style.marginRight ="6px";		
    });
});
$(document).ready(function() {
    $(".wrapoverlay").click(function() {
        $("#boxwrap").hide('slow');
        $(".wrapoverlay").hide('slow');
        $("#menu-b-menu").show('slow');
        document.getElementById("wrap").style.position="relative";
        document.getElementById("header").style.zIndex="1";
        document.getElementById("menuanchor").style.width="140px";
		document.getElementById('quicklabel').innerHTML ="Quick Look";
		document.getElementById('quicklabel').style.marginRight ="6px";		
    });
});
$(document).keyup(function(e) {
  if (e.keyCode == 27) { 
        $("#boxwrap").hide('slow');
        $(".wrapoverlay").hide('slow');
        $("#menu-b-menu").show('slow');
        document.getElementById("wrap").style.position="relative";
        document.getElementById("header").style.zIndex="1";
        document.getElementById("menuanchor").style.width="140px";
		document.getElementById('quicklabel').innerHTML ="Quick Look";
		document.getElementById('quicklabel').style.marginRight ="6px";		
  }   
});
$(document).ready(function() {
   $('#menuanchor').toggle(function() {
        $("#box1-hover").show();
        $("#boxwrap").show('slow');
        $(".wrapoverlay").show('slow');
        $("#menu-b-menu").hide();
        document.getElementById("header").style.position="relative";
        document.getElementById("wrap").style.position="fixed";
        document.getElementById("wrap").style.left="0px";
        document.getElementById("wrap").style.right="0px";
        document.getElementById("wrap").style.margin="0px auto";
        document.getElementById("header").style.zIndex="100";
        document.getElementById("menuanchor").style.width="980px";
        document.getElementById("menuanchor").style.width="980px";
		document.getElementById('quicklabel').innerHTML ="Quick Look <span class='quickbarright'>Click This Bar to Close</span>";
		document.getElementById('quicklabel').style.marginRight ="0px";		
  	}, function() {
        $("#boxwrap").hide('slow');
        $(".wrapoverlay").hide('slow');
        $("#menu-b-menu").show('slow');
        document.getElementById("wrap").style.position="relative";
        document.getElementById("header").style.zIndex="1";
        document.getElementById("menuanchor").style.width="140px";
		document.getElementById('quicklabel').innerHTML ="Quick Look";
		document.getElementById('quicklabel').style.marginRight ="6px";		
   });
});


</script>
		<div id="quickwrap">
			<div id="boxwrap" class="wrapfade">
				<ul id="quicknav" class="quickclose" style="padding-bottom:0px">
					<li id="quicklook1"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-1') == "Story Category") || (get_theme_mod('quick-type-1') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-1')); } else { $label = get_theme_mod('quick-type-1'); } echo $label; ?></a></li>
					<li id="quicklook2"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-2') == "Story Category") || (get_theme_mod('quick-type-2') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-2')); } else { $label = get_theme_mod('quick-type-2'); } echo $label; ?></a></li>
					<li id="quicklook3"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-3') == "Story Category") || (get_theme_mod('quick-type-3') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-3')); } else { $label = get_theme_mod('quick-type-3'); } echo $label; ?></a></li>
					<li id="quicklook4"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-4') == "Story Category") || (get_theme_mod('quick-type-4') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-4')); } else { $label = get_theme_mod('quick-type-4'); } echo $label; ?></a></li>
					<li id="quicklook5"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-5') == "Story Category") || (get_theme_mod('quick-type-5') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-5')); } else { $label = get_theme_mod('quick-type-5'); } echo $label; ?></a></li>
					<li id="quicklook6"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-6') == "Story Category") || (get_theme_mod('quick-type-6') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-6')); } else { $label = get_theme_mod('quick-type-6'); } echo $label; ?></a></li>
					<li id="quicklook7"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-7') == "Story Category") || (get_theme_mod('quick-type-7') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-7')); } else { $label = get_theme_mod('quick-type-7'); } echo $label; ?></a></li>
					<li id="quicklook8"><a href="#" onclick="return false"><?php if ((get_theme_mod('quick-type-8') == "Story Category") || (get_theme_mod('quick-type-8') == "Video Category")) { $label = cat_id_to_name(get_theme_mod('quick-cat-8')); } else { $label = get_theme_mod('quick-type-8'); } echo $label; ?></a></li>
					<li id="quicklook9" style="height:30px !important;padding-bottom:0px"><a style="height:30px !important;padding-bottom:0px;margin-bottom:0px;" href="#" onclick="return false">Close Window</a></li>
				</ul>
							<div id="box1-hover">
								<?php 
								if (get_theme_mod('quick-type-1') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-1'));
									}
								if (get_theme_mod('quick-type-1') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-1'));
									}
								if (get_theme_mod('quick-type-1') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-1') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box2-hover">
								<?php 
								if (get_theme_mod('quick-type-2') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-2'));
									}
								if (get_theme_mod('quick-type-2') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-2'));
									}
								if (get_theme_mod('quick-type-2') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-2') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box3-hover">
								<?php 
								if (get_theme_mod('quick-type-3') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-3'));
									}
								if (get_theme_mod('quick-type-3') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-3'));
									}
								if (get_theme_mod('quick-type-3') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-3') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box4-hover">
								<?php 
								if (get_theme_mod('quick-type-4') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-4'));
									}
								if (get_theme_mod('quick-type-4') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-4'));
									}
								if (get_theme_mod('quick-type-4') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-4') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box5-hover">
								<?php 
								if (get_theme_mod('quick-type-5') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-5'));
									}
								if (get_theme_mod('quick-type-5') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-5'));
									}
								if (get_theme_mod('quick-type-5') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-5') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box6-hover">
								<?php 
								if (get_theme_mod('quick-type-6') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-6'));
									}
								if (get_theme_mod('quick-type-6') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-6'));
									}
								if (get_theme_mod('quick-type-6') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-6') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box7-hover">
								<?php 
								if (get_theme_mod('quick-type-7') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-7'));
									}
								if (get_theme_mod('quick-type-7') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-7'));
									}
								if (get_theme_mod('quick-type-7') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-7') == "Recent Results") quick_results(); 
								?> 
							</div>
							<div id="box8-hover">
								<?php 
								if (get_theme_mod('quick-type-8') == "Story Category") {
									quick_story(get_theme_mod('quick-cat-8'));
									}
								if (get_theme_mod('quick-type-8') == "Video Category") {
									quick_video(get_theme_mod('quick-cat-8'));
									}
								if (get_theme_mod('quick-type-8') == "Upcoming Games") quick_schedule();  
								if (get_theme_mod('quick-type-8') == "Recent Results") quick_results(); 
								?> 
							</div>
						</div>
					<div class="wrapoverlay"></div>
						
						</div>
<?php wp_reset_query(); ?>