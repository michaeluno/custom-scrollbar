<?php 
/**
	Admin Page Framework v3.8.7b02 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_Form_View___Script_SortableField extends CustomScrollbar_AdminPageFramework_Form_View___Script_Base {
    public function construct() {
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
            // the options for the sortable plugin
            { 
                items: '> div:not( .disabled )',
            } 
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
class CustomScrollbar_AdminPageFramework_Form_View___Script_SortableSection extends CustomScrollbar_AdminPageFramework_Form_View___Script_SortableField {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function($) {
    $.fn.enableCustomScrollbar_AdminPageFrameworkSortableSections = function( sSectionsContainerID ) {

        var _oTarget    = 'string' === typeof sSectionsContainerID 
            ? $( '#' + sSectionsContainerID + '.sortable-section' )
            : this;

        // For tabbed sections, enable the sort to the tabs.
        var _bIsTabbed      = _oTarget.hasClass( 'custom-scrollbar-section-tabs-contents' );
        var _bCollapsible   = 0 < _oTarget.children( '.custom-scrollbar-section.is_subsection_collapsible' ).length;

        var _oTarget        = _bIsTabbed
            ? _oTarget.find( 'ul.custom-scrollbar-section-tabs' )
            : _oTarget;

        _oTarget.unbind( 'sortupdate' );
        _oTarget.unbind( 'sortstop' );
        
        var _aSortableOptions = { 
                items: _bIsTabbed
                    ? '> li:not( .disabled )'
                    : '> div:not( .disabled, .custom-scrollbar-collapsible-toggle-all-button-container )', 
                handle: _bCollapsible
                    ? '.custom-scrollbar-section-caption'
                    : false,
                
                stop: function(e,ui) {

                    // Callback the registered callback functions.
                    jQuery( this ).trigger( 
                        'custom-scrollbar_stopped_sorting_sections', 
                        []  // parameters for the callbacks 
                    );                    

                },
			
                
                // @todo Figure out how to allow the user to highlight text in sortable elements.
                // cancel: '.custom-scrollbar-section-description, .custom-scrollbar-section-title'
                
            }
        var _oSortable  = _oTarget.sortable( _aSortableOptions );               
        
        if ( ! _bIsTabbed ) {
            
            _oSortable.bind( 'sortstop', function() {
                                    
                jQuery( this ).find( 'caption > .custom-scrollbar-section-title:not(.custom-scrollbar-collapsible-sections-title,.custom-scrollbar-collapsible-section-title)' ).first().show();
                jQuery( this ).find( 'caption > .custom-scrollbar-section-title:not(.custom-scrollbar-collapsible-sections-title,.custom-scrollbar-collapsible-section-title)' ).not( ':first' ).hide();
                
            } );            
            
        }            
    
    };
}( jQuery ));
JAVASCRIPTS;
        
    }
    static private $_aSetContainerIDsForSortableSections = array();
    static public function getEnabler($sContainerTagID, $aSettings, $oMsg) {
        if (empty($aSettings)) {
            return '';
        }
        if (in_array($sContainerTagID, self::$_aSetContainerIDsForSortableSections)) {
            return '';
        }
        self::$_aSetContainerIDsForSortableSections[$sContainerTagID] = $sContainerTagID;
        new self($oMsg);
        $_sScript = <<<JAVASCRIPTS
jQuery( document ).ready( function() {    
    jQuery( '#{$sContainerTagID}' ).enableCustomScrollbar_AdminPageFrameworkSortableSections( '{$sContainerTagID}' ); 
});            
JAVASCRIPTS;
        return "<script type='text/javascript' class='custom-scrollbar-section-sortable-script'>" . '/* <![CDATA[ */' . $_sScript . '/* ]]> */' . "</script>";
    }
}
