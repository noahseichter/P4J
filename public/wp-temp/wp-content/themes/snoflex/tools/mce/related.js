(function() {
   tinymce.create('tinymce.plugins.related', {
      init : function(ed, url) {
         ed.addButton('related', {
            title : 'Related Stories',
            image : url+'/related.png',
            onclick : function() {
               var title = prompt("Title for Widget", "Related Stories");
               var stories = prompt("Enter a comma separated list of Story IDs.", "");
			   var align = prompt("Alignment -- left, center, or right", "");
               if (stories != null && stories != ''){
               
               			var shortcode = '[related';
               			if (align != null && align != '') shortcode = shortcode+' align="'+align+'"';
               			if (title != null && title != '') shortcode = shortcode+' title="'+title+'"';
               			if (stories != null && stories != '') shortcode = shortcode+' stories="'+stories+'"';
               			shortcode = shortcode+']';
               			
                     ed.execCommand('mceInsertContent', false, shortcode);
               }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Related Stories",
            author : 'School Newspapers Online',
            authorurl : 'http://www.schoolnewspapersonline.com',
            infourl : 'http://www.schoolnewspapersonline.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('related', tinymce.plugins.related);
})();