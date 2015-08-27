<?php
/**
 Admin Page Framework v3.6.0b07 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class CustomScrollbar_AdminPageFramework_Script_SortableField extends CustomScrollbar_AdminPageFramework_Script_Base {
    protected function construct() {
        wp_enqueue_script('jquery-ui-sortable');
    }
    static public function getScript() {
        return <<<JAVASCRIPTS
(function($) {
    $.fn.enableCustomScrollbar_AdminPageFrameworkSortableFields = function( sFieldsContainerID ) {

        var _oTarget    = 'string' === typeof sFieldsContainerID
            ? $( '#' + sFieldsContainerID + '.sortable' )
            : this;
        
        _oTarget.unbind( 'sortupdate' );
        _oTarget.unbind( 'sortstop' );
        var _oSortable  = _oTarget.sortable(
            { items: '> div:not( .disabled )', } // the options for the sortable plugin
        );
        
        // Callback the registered functions.
        _oSortable.bind( 'sortstop', function() {
            $( this ).callBackStoppedSortingFields( 
                $( this ).data( 'type' ),
                $( this ).attr( 'id' ),
                0  // call type 0: fields, 1: sections
            );  
        });
        _oSortable.bind( 'sortupdate', function() {
            $( this ).callBackSortedFields( 
                $( this ).data( 'type' ),
                $( this ).attr( 'id' ),
                0  // call type 0: fields, 1: sections
            );
        });                 
    
    };
}( jQuery ));
JAVASCRIPTS;
        
    }
}