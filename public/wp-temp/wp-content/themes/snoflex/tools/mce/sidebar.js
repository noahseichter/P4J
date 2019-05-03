(function() {
   tinymce.create('tinymce.plugins.sidebar', {
      init : function(ed, url) {
         ed.addButton('sidebar', {
            title : 'Sidebar',
            image : url+'/sidebar.png',
            onclick : function() {
               var title = prompt("Sidebar Title", "");
               var text = prompt("Sidebar Text", "");
			   var align = prompt("Alignment -- left or right", "");
			   var photo = prompt("Photo ID Number (optional)");
               if ((title != null && title != '') || (text != null && text != '')) {
               
               			var shortcode = '[sidebar';
               			if (title != null && title != '') shortcode = shortcode+' title="'+title+'"';
               			if (align != null && align != '') shortcode = shortcode+' align="'+align+'"';
               			if (photo != null && photo != '') shortcode = shortcode+' photo="'+photo+'"';
               			shortcode = shortcode+']'+text+'[/sidebar]';
               			
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
            longname : "Sidebar",
            author : 'School Newspapers Online',
            authorurl : 'http://www.schoolnewspapersonline.com',
            infourl : 'http://www.schoolnewspapersonline.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('sidebar', tinymce.plugins.sidebar);
})();