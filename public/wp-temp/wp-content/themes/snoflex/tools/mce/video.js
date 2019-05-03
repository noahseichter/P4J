(function() {
   tinymce.create('tinymce.plugins.snovideo', {
      init : function(ed, url) {
         ed.addButton('snovideo', {
            title : 'Video',
            image : url+'/videoembed.png',
            onclick : function() {
                           var text = prompt("Video Embed Code", "");
               var credit = prompt("Video Credit", "");
			   var align = prompt("Alignment -- left, center, or right", "");
               if (text != null && text != ''){
               
               			var shortcode = '[video';
               			if (align != null && align != '') shortcode = shortcode+' align="'+align+'"';
               			if (credit != null && credit != '') shortcode = shortcode+' credit="'+credit+'"';
               			shortcode = shortcode+']'+text+'[/video]';
               			
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
            longname : "Video",
            author : 'School Newspapers Online',
            authorurl : 'http://www.schoolnewspapersonline.com',
            infourl : 'http://www.schoolnewspapersonline.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('snovideo', tinymce.plugins.snovideo);
})();