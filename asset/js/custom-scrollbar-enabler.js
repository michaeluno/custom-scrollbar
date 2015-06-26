(function($){
    $( document ).ready( function() {
        
        // parse the passed data
        if ( 'undefined' === typeof custom_scrollbar_enabler ) {
            return true;
        }
        $.each( custom_scrollbar_enabler, function( _iIndex, _aScrollbar ) {
                        
            if ( 'undefined' === typeof _aScrollbar[ 'selector' ] ) {
                return true; // continue
            }
                        
            var _sAxis = '';
            if ( _aScrollbar[ 'height' ][ 'size' ] ) {
                _sAxis += 'y';
            }
            if ( _aScrollbar[ 'width' ][ 'size' ] ) {
                _sAxis += 'x';
            }            
            var _sWidth = _aScrollbar[ 'width' ][ 'size' ]
                ? ( 'px' === _aScrollbar[ 'width' ][ 'unit' ] 
                    ? Number( _aScrollbar[ 'width' ][ 'size' ] )
                    : String( _aScrollbar[ 'width' ][ 'size' ] )
                )
                : false;
            var _sHeight = _aScrollbar[ 'height' ][ 'size' ]
                ? ( 'px' === _aScrollbar[ 'height' ][ 'unit' ] 
                    ? Number( _aScrollbar[ 'height' ][ 'size' ] )
                    : String( _aScrollbar[ 'height' ][ 'size' ] )
                )
                : false;   
            var _aOptions = {
                axis: _sAxis, // vertical/horizontal scrollbar
                theme: _aScrollbar[ 'theme' ],
                // setWidth: _sWidth,  // integer - px, string - %
                setHeight: _sHeight, // integer - px, string - %
                scrollbarPosition: _aScrollbar[ 'position' ],
            };

            // We add custom class name to the target element.
            var _sElementClassName = 'custom_scrollbar_' + String( _iIndex );
            $( _aScrollbar[ 'selector' ] ).addClass( _sElementClassName );
            
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
            
        });            
     
        
    });
    
}(jQuery));