<?php
class CustomScrollbar_AdminPageFramework_Script_OptionStorage extends CustomScrollbar_AdminPageFramework_Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function ( $ ) {
            
    $.fn.aCustomScrollbar_AdminPageFrameworkInputOptions = {}; 
                            
    $.fn.storeCustomScrollbar_AdminPageFrameworkInputOptions = function( sID, vOptions ) {
        var sID = sID.replace( /__\d+_/, '___' );	// remove the section index. The g modifier is not used so it will replace only the first occurrence.
        $.fn.aCustomScrollbar_AdminPageFrameworkInputOptions[ sID ] = vOptions;
    };	
    $.fn.getCustomScrollbar_AdminPageFrameworkInputOptions = function( sID ) {
        var sID = sID.replace( /__\d+_/, '___' ); // remove the section index
        return ( 'undefined' === typeof $.fn.aCustomScrollbar_AdminPageFrameworkInputOptions[ sID ] )
            ? null
            : $.fn.aCustomScrollbar_AdminPageFrameworkInputOptions[ sID ];
    }

}( jQuery ));
JAVASCRIPTS;
        
    }
}