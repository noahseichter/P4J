    $(document).ready(function(){ 
        $("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    40,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
        }).superfish({
    		delay:      200,     
        	speed:		'fast'
        });  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
			var windowWidth;
        	windowWidth= $(window).width();
        	$( window ).resize(function() {
           		windowWidth = $(window).width();
        	});

        	$('.sf-menu').superfish({
            	onBeforeShow : function (){                 
            		if(!this.is('.sf-menu>li>ul')){
            	        var subMenuWidth = $(this).width();
            	        var parentLi = $(this).parent();                    
            	        var parentWidth = parentLi.width() -8 ;
            	        var subMenuRight = parentLi.offset().left + parentWidth + subMenuWidth;
            	        if(subMenuRight > windowWidth){
            	           	$(this).css('left','auto');
            	            $(this).css('right', parentWidth+'px');
            	        } else {
            	           	$(this).css('right','auto');
            	           	parentWidth +=8;
            	            $(this).css('left', parentWidth+'px');
            	        }
            	    }
            	}
        	});
    }); 
jQuery().ready(function( jQuery ) {
    jQuery(".wp-caption").width(function() {
       return jQuery('img', this).width();
    });
});
