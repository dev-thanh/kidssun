CKEDITOR.plugins.add( 'relUnfollow', {
    icons: 'relUnfollow',
    init: function( editor ) {
        editor.addCommand( 'insertRelUnfollow', {
            exec: function( editor ) {
                editor.dataProcessor.htmlFilter.addRules({
                    elements : {
                        a : function( element ) {
                            element.attributes.rel = 'nofollow';
                        }
                    }
                });
            }
        });

        editor.ui.addButton( 'relUnfollow', {
            label: 'Insert rel=unfollow',
            command: 'insertRelUnfollow',
            toolbar: 'insert'
        });
    }
});