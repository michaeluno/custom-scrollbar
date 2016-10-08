/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015-2016 Michael Uno
 * 
 */
(function($){
    
    $( document ).ready( function() {
        
        /**
         * @see     http://stackoverflow.com/questions/263965/how-can-i-convert-a-string-to-boolean-in-javascript/1414175#1414175
         */
        function _getBoolean( string ) {
            switch(string.toLowerCase().trim()){
                case "true": case "yes": case "1": return true;
                case "false": case "no": case "0": case null: return false;
                default: return Boolean(string);
            }
        }        
        
        function _initalizeCustomScrollbars() {
         
            // parse the passed data
            if ( 'undefined' === typeof custom_scrollbar_enabler ) {
                return true;
            }
            $.each( custom_scrollbar_enabler[ 'scrollbars' ], function( _iIndex, _aScrollbar ) {
                            
                if ( 'undefined' === typeof _aScrollbar[ 'selector' ] ) {
                    return true; // continue
                }

                var _iWidth  = Number( _aScrollbar[ 'width' ][ 'size' ] );                        
                var _iHeight = Number( _aScrollbar[ 'height' ][ 'size' ] );
                var _sAxis = '';
                if ( _iHeight ) {
                    _sAxis += 'y';
                }
                if ( _iWidth ) {
                    _sAxis += 'x';
                }    
                
                var _bisWidth = _iWidth
                    ? ( 'px' === _aScrollbar[ 'width' ][ 'unit' ] 
                        ? _iWidth
                        : String( _iWidth ) + '%'
                    )
                    : false;
                var _bisHeight = _iHeight
                    ? ( 'px' === _aScrollbar[ 'height' ][ 'unit' ] 
                        ? _iHeight
                        : String( _iHeight ) + '%'
                    )
                    : false;   
                    
                var _aOptions = {
                    axis                : _sAxis, // vertical/horizontal scrollbar. e.g. 'x', 'y', 'xy'
                    theme               : _aScrollbar[ 'theme' ],
                    setWidth            : _bisWidth,  // (integer) px, (string) %, (boolean) false
                    setHeight           : _bisHeight, // (integer) px, (string) %, (boolean) false
                    scrollbarPosition   : _aScrollbar[ 'position' ],
                    advanced            : {
                        autoExpandHorizontalScroll  : true  // required for horizontal scrollbar
                    } 
                };
                
                // We add custom class name to the target element.
                var _sElementClassName = 'custom_scrollbar_' + String( _iIndex );
                $( _aScrollbar[ 'selector' ] ).addClass( _sElementClassName );

                // Custom inline CSS rules.
                $.each( _aScrollbar[ 'inline_css' ], function( _iIndex, _aInlineCSS ) {
                    
                    if ( 'undefined' === typeof _aInlineCSS[ 'property' ] ) {
                        return true; // continue
                    }   
                    if ( '' === _aInlineCSS[ 'property' ] ) {
                        return true; // continue
                    }                      
                    if ( 'undefined' === typeof _aInlineCSS[ 'value' ] ) {
                        return true; // continue
                    }
                    $( _aScrollbar[ 'selector' ] ).css( _aInlineCSS[ 'property' ], _aInlineCSS[ 'value' ] );
                    
                    
                } );            
                                
                // Initialize the scrollbar.
                $( _aScrollbar[ 'selector' ] ).mCustomScrollbar( 
                    _aOptions 
                );

                // Custom colors 
                var _sSelector = '.' + _sElementClassName;
                if ( _aScrollbar[ 'mCSB_draggerContainer' ] ) {
                    $( _sSelector + ' .mCSB_draggerContainer' ).css( 'background-color', _aScrollbar[ 'mCSB_draggerContainer' ] );
                }            
                if ( _aScrollbar[ 'mCSB_dragger' ] ) {
                    $( _sSelector + ' .mCSB_dragger' ).css( 'background-color', _aScrollbar[ 'mCSB_dragger' ] );
                }
                if ( _aScrollbar[ 'mCSB_dragger_bar' ] ) {
                    $( _sSelector + ' .mCSB_dragger_bar' ).css( 'background-color', _aScrollbar[ 'mCSB_dragger_bar' ] );
                }
                if ( _aScrollbar[ 'mCSB_draggerRail' ] ) {
                    $( _sSelector + ' .mCSB_draggerRail' ).css( 'background-color', _aScrollbar[ 'mCSB_draggerRail' ] );
                }            
                if ( _aScrollbar[ 'mCSB_scrollTools' ] ) {
                    $( _sSelector + ' .mCSB_scrollTools' ).css( 'background-color', _aScrollbar[ 'mCSB_scrollTools' ] );
                }                        
                
            }); // .each()       
         
        } // _initalizeCustomScrollbars()
        
        _initalizeCustomScrollbars();
        
        // For AJAX page loads,
        $( document ).ajaxStop( function() {
            if ( ! _getBoolean( custom_scrollbar_enabler[ 'load' ][ 'ajax_initialization' ] ) ) {
                return;
            }
            _initalizeCustomScrollbars();
        });        
        
    }); // .ready()
    
}(jQuery));