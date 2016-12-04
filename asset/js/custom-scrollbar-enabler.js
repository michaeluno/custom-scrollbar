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

        function _initalizeCustomScrollbars( $aScrollbars ) {

            $.each( $aScrollbars, function( _iIndex, _aScrollbar ) {

                _setInlineCSS( _aScrollbar );

                $( _aScrollbar[ 'selector' ] ).mCustomScrollbar( _getScrollbarOptions( _aScrollbar ) );

                _setCustomColors( _aScrollbar, _iIndex );
                
            } );
         
        } // _initalizeCustomScrollbars()

            function _getScrollbarOptions( _aScrollbar ) {

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

                var _aDefaults = {
                    advanced            : {
                        autoExpandHorizontalScroll  : true  // required for horizontal scrollbar
                    },
                    mouseWheel          : {
                        scrollAmount: 'auto'  // `auto` by default
                    },
                    scrollButtons       : {
                        enable: true,
                        scrollAmount: 1000
                    }
                };
                var _aOptions = {
                    axis                : _sAxis, // vertical/horizontal scrollbar. e.g. 'x', 'y', 'xy'
                    theme               : _aScrollbar[ 'theme' ],
                    setWidth            : _bisWidth,  // (integer) px, (string) %, (boolean) false
                    setHeight           : _bisHeight, // (integer) px, (string) %, (boolean) false
                    scrollbarPosition   : _aScrollbar[ 'position' ]
                };
                $_aOptions = $.extend(
                    true,   // recursive
                    _aDefaults,
                    _aScrollbar,
                    _aOptions
                );
                return $_aOptions;

            }
            function _setInlineCSS( _aScrollbar ) {

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
                    $( _aScrollbar[ 'selector' ] ).css(
                        _aInlineCSS[ 'property' ], _aInlineCSS[ 'value' ]
                    );

                } );

            }
            function _setCustomColors( _aScrollbar, _iIndex ) {

                // We add a custom class name to the target element.
                var _sElementClassName = 'custom_scrollbar_' + String( _iIndex );
                $( _aScrollbar[ 'selector' ] ).addClass( _sElementClassName );

                var _sSelector = '.' + _sElementClassName;
                if ( _aScrollbar[ 'mCSB_draggerContainer' ] ) {
                    $( _sSelector + ' .mCSB_draggerContainer' ).css( 'background-color', _aScrollbar[ 'mCSB_draggerContainer' ] );
                }
                if ( _aScrollbar[ 'mCSB_dragger' ] ) {
                    $( _sSelector + ' .mCSB_dragger' ).css( 'background-color', _aScrollbar[ 'mCSB_dragger' ] );
                }
                if ( _aScrollbar[ 'mCSB_dragger_bar' ] ) {
                    $( _sSelector + ' .mCSB_dragger_bar').css( 'background-color', _aScrollbar[ 'mCSB_dragger_bar' ] );
                }
                if ( _aScrollbar[ 'mCSB_draggerRail' ] ) {
                    $( _sSelector + ' .mCSB_draggerRail' ).css( 'background-color', _aScrollbar[ 'mCSB_draggerRail' ] );
                }
                if ( _aScrollbar[ 'mCSB_scrollTools' ] ) {
                    $( _sSelector + ' .mCSB_scrollTools' ).css( 'background-color', _aScrollbar[ 'mCSB_scrollTools' ] );
                }

            }

        // Start the main routine.
        if ( 'undefined' === typeof custom_scrollbar_enabler ) {
            return true;
        }

        _initalizeCustomScrollbars( custom_scrollbar_enabler[ 'scrollbars' ] );
        
        // For AJAX page loads,
        $( document ).ajaxStop( function() {

            var _aScrollbars = {};
            $.each( custom_scrollbar_enabler[ 'scrollbars' ], function( _iIndex, _aScrollbar ) {
                if ( ! _aScrollbar[ 'initialize_on_ajax_load' ] ) {
                    return true;    // continue
                }
                _aScrollbars[ _iIndex ] = _aScrollbar;
            } );
            _initalizeCustomScrollbars( _aScrollbars );

        });        
        
    }); // .ready()
    
}(jQuery));