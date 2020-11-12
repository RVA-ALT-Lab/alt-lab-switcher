(function() {
    tinymce.PluginManager.add( 'swpbtn', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('swpbtn', {
            title: 'Click button to language switcher shortcode',
            cmd: 'swpbtn',
            image: url + '/switcher.png',
        });
        editor.addCommand('swpbtn', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
           
            var open_column = '[switcher]<br>[main]' + selected_text + '[/main]<br>[alt][/alt]<br>[/switcher]';
            var close_column = '';
            var return_text = '';
            return_text = open_column + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });
    });
})();