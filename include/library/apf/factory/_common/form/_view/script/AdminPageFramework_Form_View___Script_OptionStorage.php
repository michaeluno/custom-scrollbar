<?php 
/**
	Admin Page Framework v3.8.24 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2020, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_Form_View___Script_OptionStorage extends CustomScrollbar_AdminPageFramework_Form_View___Script_Base {
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
    