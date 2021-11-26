(function(){
    tinymce.create('tinymce.plugins.MyPluginName', {
      init: function(ed, url){
        ed.addButton('s3aBtn', {
          title: 'Fancy S3A Button',
          cmd: 's3aBtnCmd',
          image: url + '/button.png'
        });
        ed.addCommand('s3aBtnCmd', function(){
          var selectedText = ed.selection.getContent({format: 'html'});
          var win = ed.windowManager.open({
            title: 'Button Properties',
            body: [
              {
                type: 'textbox',
                name: 'buttontext',
                label: 'Button Text',
                minWidth: 500,
                value: selectedText
              },
              {
                type: 'textbox',
                name: 'buttonurl',
                label: 'Button Url',
                minWidth: 500,
                value: ''
              },
              {
                type: 'checkbox',
                name: 'newwindow',
                label: 'Open in New Window',
                value: ''
              }
            ],
            buttons: [
              {
                text: "Ok",
                subtype: "primary",
                onclick: function() {
                  win.submit();
                }
              },
              {
                text: "Cancel",
                onclick: function() {
                  win.close();
                }
              }
            ],
            onsubmit: function(e){
                let target ='';
              if( e.data.newwindow ) {
                target = 'target="_blank"';
              }
              var returnText = '<a href="' + e.data.buttonurl + '"' + target + 'class="decorative magenta shape3">' + e.data.buttontext + '</a>';
              ed.execCommand('mceInsertContent', 0, returnText);
            }
          });
        });
      },
      getInfo: function() {
        return {
          longname : 'Add S3A styled Button',
          author : 'Chad Rossouw for HdK',
          authorurl : 'https://wearehdk.com',
          version : "1.0"
        };
      }
    });
    tinymce.PluginManager.add( 'mytinymceplugin', tinymce.plugins.MyPluginName );
  })();
