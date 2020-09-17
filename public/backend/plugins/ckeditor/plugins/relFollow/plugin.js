CKEDITOR.plugins.add( 'relFollow', {
    icons: 'relFollow',
    init: function( editor ) {
        editor.addCommand( 'insertRelFollow', {
            exec: function( editor ) {
                editor.dataProcessor.htmlFilter.addRules({
                    elements : {
                        a : function( element ) {
                            element.attributes.rel = 'follow';
                        }
                    }
                });
            }
        });

        editor.ui.addButton( 'relFollow', {
            label: 'Insert rel=follow',
            command: 'insertRelFollow',
            toolbar: 'insert'
        });
    }
});