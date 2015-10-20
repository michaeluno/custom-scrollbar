<?php
class CustomScrollbar_AdminPageFramework_Script_CheckboxSelector extends CustomScrollbar_AdminPageFramework_Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function ( $ ) {

    /**
     * Checks all the checkboxes in siblings.
     */        
    $.fn.selectAllCustomScrollbar_AdminPageFrameworkCheckboxes = function() {
        jQuery( this ).parent()
            .find( 'input[type=checkbox]' )
            .attr( 'checked', true );                
    }
    /**
     * Unchecks all the checkboxes in siblings.
     */
    $.fn.deselectAllCustomScrollbar_AdminPageFrameworkCheckboxes = function() {
        jQuery( this ).parent()
            .find( 'input[type=checkbox]' )
            .attr( 'checked', false );                             
    }          

}( jQuery ));
JAVASCRIPTS;
        
    }
}