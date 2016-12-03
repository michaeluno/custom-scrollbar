<?php 
/**
	Admin Page Framework v3.8.12 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_Form_View___Script_CheckboxSelector extends CustomScrollbar_AdminPageFramework_Form_View___Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function ( $ ) {

    /**
     * Checks all the checkboxes in siblings.
     */        
    $.fn.selectAllCustomScrollbar_AdminPageFrameworkCheckboxes = function() {
        jQuery( this ).parent()
            .find( 'input[type=checkbox]' )
            .attr( 'checked', true )
            .trigger( 'change' );   // 3.8.8+
    }
    /**
     * Unchecks all the checkboxes in siblings.
     */
    $.fn.deselectAllCustomScrollbar_AdminPageFrameworkCheckboxes = function() {
        jQuery( this ).parent()
            .find( 'input[type=checkbox]' )
            .attr( 'checked', false )
            .trigger( 'change' );   // 3.8.8+
    }          

}( jQuery ));
JAVASCRIPTS;
        
    }
}
