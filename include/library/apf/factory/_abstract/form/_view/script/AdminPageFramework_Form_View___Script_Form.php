<?php
class CustomScrollbar_AdminPageFramework_Form_View___Script_Form extends CustomScrollbar_AdminPageFramework_Form_View___Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
( function( $ ) {

    var _removeCustomScrollbar_AdminPageFrameworkLoadingOutputs = function() {

        jQuery( '.custom-scrollbar-form-loading' ).remove();
        jQuery( '.custom-scrollbar-form-js-on' )
            .hide()
            .css( 'visibility', 'visible' )
            .fadeIn( 200 )
            .removeClass( '.custom-scrollbar-form-js-on' )
            ;
    
    }
    
    /**
     * Renderisn forms is heavy and unformatted layouts will be hidden with a script embedded in the head tag.
     * Now when the document is ready, restore that visibility state so that the form will appear.
     */
    jQuery( document ).ready( function() {
        _removeCustomScrollbar_AdminPageFrameworkLoadingOutputs();
    });    

    /**
     * Gets triggered when a widget of the framework is saved.
     * @since    DEVVER
     */
    $( document ).bind( 'admin_page_framework_saved_widget', function( event, oWidget ){
        jQuery( '.custom-scrollbar-form-loading' ).remove();
    });    
    
}( jQuery ));
JAVASCRIPTS;
        
    }
    static private $_bLoadedTabEnablerScript = false;
}