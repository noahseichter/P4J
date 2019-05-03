(function() {
   tinymce.create('tinymce.plugins.pullquote', {
      init : function(ed, url) {
         ed.addButton('pullquote', {
            title : 'Pull Quote',
            image : url+'/pullquote.png',
            onclick : function() {
                           var text = prompt("Pull Quote Text", "");
               var speaker = prompt("Pull Quote Speaker", "");
			   var align = prompt("Alignment -- left, center, or right", "");
			   var photo = prompt("Photo ID (optional)", "");
               if (text != null && text != ''){
               
               			var shortcode = '[pullquote';
               			if (align != null && align != '') shortcode = shortcode+' align="'+align+'"';
               			if (speaker != null && speaker != '') shortcode = shortcode+' speaker="'+speaker+'"';
               			if (photo != null && photo != '') shortcode = shortcode+' photo="'+photo+'"';
               			shortcode = shortcode+']'+text+'[/pullquote]';
               			
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
            longname : "Pull Quotes",
            author : 'School Newspapers Online',
            authorurl : 'http://www.schoolnewspapersonline.com',
            infourl : 'http://www.schoolnewspapersonline.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('pullquote', tinymce.plugins.pullquote);
})();