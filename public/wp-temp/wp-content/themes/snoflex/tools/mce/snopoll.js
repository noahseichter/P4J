(function() {
   tinymce.create('tinymce.plugins.video', {
      init : function(ed, url) {
         ed.addButton('snopoll', {
            title : 'Add Poll',
            image : url+'/snopoll.gif',
            onclick : function() {
               var pollid = prompt("Poll ID Number", "");
			   var align = prompt("Alignment -- left, center, or right", "");
               if (pollid != null && pollid != ''){
               
               			var shortcode = '[poll';
               			if (align != null && align != '') shortcode = shortcode+' align="'+align+'"';
               			if (pollid != null && pollid != '') shortcode = shortcode+' id="'+pollid+'"';
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
            longname : "Poll",
            author : 'School Newspapers Online',
            authorurl : 'http://www.schoolnewspapersonline.com',
            infourl : 'http://www.schoolnewspapersonline.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('snopoll', tinymce.plugins.snopoll);
})();