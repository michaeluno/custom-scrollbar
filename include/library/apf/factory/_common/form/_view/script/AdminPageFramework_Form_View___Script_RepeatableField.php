<?php 
/**
	Admin Page Framework v3.8.7b02 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_Form_View___Script_RepeatableField extends CustomScrollbar_AdminPageFramework_Form_View___Script_Base {
    static public function getScript() {
        $_aParams = func_get_args() + array(null);
        $_oMsg = $_aParams[0];
        $sCannotAddMore = $_oMsg->get('allowed_maximum_number_of_fields');
        $sCannotRemoveMore = $_oMsg->get('allowed_minimum_number_of_fields');
        return <<<JAVASCRIPTS
(function ( $ ) {
        
    /**
     * Bind field-repeating events to repeatable buttons for individual fields.
     * @remark      This method can be called from a fields container or a cloned field container.
     */
    $.fn.updateCustomScrollbar_AdminPageFrameworkRepeatableFields = function( aSettings ) {
        
        var nodeThis            = this; 
        var _sFieldsContainerID = nodeThis.find( '.repeatable-field-add-button' ).first().data( 'id' );
        
        /* Store the fields specific options in an array  */
        if ( ! $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions ) {
            $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions = [];
        }
        if ( ! $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions.hasOwnProperty( _sFieldsContainerID ) ) {     
            $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ] = $.extend({    
                max: 0, // These are the defaults.
                min: 0,
                fadein: 500,
                fadeout: 500,
                }, aSettings );
        }
        var _aOptions = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ];

        /* Set the option values in the data attributes so that when a section is repeated and creates a brand new field container, it can refer to the options */
// @todo For nested fields, the `find()` method should be avoided.
        $( nodeThis ).find( '.custom-scrollbar-repeatable-field-buttons' ).attr( 'data-max', _aOptions[ 'max' ] );
        $( nodeThis ).find( '.custom-scrollbar-repeatable-field-buttons' ).attr( 'data-min', _aOptions[ 'min' ] );
        $( nodeThis ).find( '.custom-scrollbar-repeatable-field-buttons' ).attr( 'data-fadein', _aOptions[ 'fadein' ] );
        $( nodeThis ).find( '.custom-scrollbar-repeatable-field-buttons' ).attr( 'data-fadeout', _aOptions[ 'fadeout' ] );
        
        /* The Add button behavior - if the tag id is given, multiple buttons will be selected. 
         * Otherwise, a field node is given and a single button will be selected. */
// @todo For nested fields, the `find()` method should be avoided.         
        $( nodeThis ).find( '.repeatable-field-add-button' ).unbind( 'click' );
        $( nodeThis ).find( '.repeatable-field-add-button' ).click( function() {
            $( this ).addCustomScrollbar_AdminPageFrameworkRepeatableField();
            return false; // will not click after that
        });

        /* The Remove button behavior */
// @todo For nested fields, the `find()` method should be avoided.        
        $( nodeThis ).find( '.repeatable-field-remove-button' ).unbind( 'click' );
        $( nodeThis ).find( '.repeatable-field-remove-button' ).click( function() {
            $( this ).removeCustomScrollbar_AdminPageFrameworkRepeatableField();
            return false; // will not click after that
        });

        /* If the number of fields is less than the set minimum value, add fields. */
        var _sFieldID           = nodeThis.find( '.repeatable-field-add-button' ).first().closest( '.custom-scrollbar-field' ).attr( 'id' );
        var _nCurrentFieldCount = jQuery( '#' + _sFieldsContainerID ).find( '.custom-scrollbar-field' ).length;
        if ( _aOptions[ 'min' ] > 0 && _nCurrentFieldCount > 0 ) {
            if ( ( _aOptions[ 'min' ] - _nCurrentFieldCount ) > 0 ) {     
                $( '#' + _sFieldID ).addCustomScrollbar_AdminPageFrameworkRepeatableField( _sFieldID );  
            }
        }
        
    };
    
    /**
     * Adds a repeatable field.
     * 
     * This method is called when the user presses the + repeatable button.
     */
    $.fn.addCustomScrollbar_AdminPageFrameworkRepeatableField = function( sFieldContainerID ) {
        
        if ( 'undefined' === typeof sFieldContainerID ) {
            var sFieldContainerID = $( this ).closest( '.custom-scrollbar-field' ).attr( 'id' );
        }

        var nodeFieldContainer  = $( '#' + sFieldContainerID );
        var nodeNewField        = nodeFieldContainer.clone(); // clone without bind events.
        var nodeFieldsContainer = nodeFieldContainer.closest( '.custom-scrollbar-fields' );
        var _sFieldsContainerID = nodeFieldsContainer.attr( 'id' );

        // If the set maximum number of fields already exists, do not add.
        if ( ! $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions.hasOwnProperty( _sFieldsContainerID ) ) {     
            var nodeButtonContainer = nodeFieldContainer.find( '.custom-scrollbar-repeatable-field-buttons' );
            $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ] = {    
                max: nodeButtonContainer.attr( 'data-max' ), // These are the defaults.
                min: nodeButtonContainer.attr( 'data-min' ),
                fadein: nodeButtonContainer.attr( 'data-fadein' ),
                fadeout: nodeButtonContainer.attr( 'data-fadeout' ),
            };
        }  
       
        var _iFadein  = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'fadein' ];
        var _iFadeout = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'fadeout' ];

        // Show a warning message if the user tries to add more fields than the number of allowed fields.
        var sMaxNumberOfFields = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ]['max'];
        if ( sMaxNumberOfFields != 0 && nodeFieldsContainer.find( '.custom-scrollbar-field' ).length >= sMaxNumberOfFields ) {
            var nodeLastRepeaterButtons = nodeFieldContainer.find( '.custom-scrollbar-repeatable-field-buttons' ).last();
            var sMessage                = $( this ).formatPrintText( '{$sCannotAddMore}', sMaxNumberOfFields );
            var nodeMessage             = $( '<span class=\"repeatable-error repeatable-field-error\" id=\"repeatable-error-' + _sFieldsContainerID + '\" >' + sMessage + '</span>' );
            if ( nodeFieldsContainer.find( '#repeatable-error-' + _sFieldsContainerID ).length > 0 ) {
                nodeFieldsContainer.find( '#repeatable-error-' + _sFieldsContainerID ).replaceWith( nodeMessage );
            } else {
                nodeLastRepeaterButtons.before( nodeMessage );
            }
            nodeMessage.delay( 2000 ).fadeOut( _iFadeout );
            return;     
        }
        
        // Empty values.
        nodeNewField.find( 'input:not([type=radio], [type=checkbox], [type=submit], [type=hidden]),textarea' ).val( '' ); // empty the value     
        nodeNewField.find( 'input[type=checkbox]' ).prop( 'checked', false ); // uncheck checkboxes.
        nodeNewField.find( '.repeatable-error' ).remove(); // remove error messages.
        
        // Add the cloned new field element.
        if ( _iFadein ) {
            nodeNewField
                .hide()
                .insertAfter( nodeFieldContainer )
                .delay( 100 )
                .fadeIn( _iFadein );
        } else {            
            nodeNewField.insertAfter( nodeFieldContainer );    
        }

        // 3.6.0+ Increment name and id attributes of the newly cloned field.
        _incrementFieldAttributes( nodeNewField, nodeFieldsContainer );
               
        /** 
         * Rebind the click event to the + and - buttons - important to update AFTER inserting the clone to the document node since the update method needs to count the fields. 
         * Also do this after updating the attributes since the script needs to check the last added id for repeatable field options such as 'min'.
         */
        nodeNewField.updateCustomScrollbar_AdminPageFrameworkRepeatableFields();
        
        // It seems radio buttons of the original field need to be reassigned. Otherwise, the checked items will be gone.
        nodeFieldContainer.find( 'input[type=radio][checked=checked]' ).prop( 'checked', 'checked' );
        
        // Call back the registered functions.
        nodeNewField.trigger( 
            'custom-scrollbar_repeated_field', 
            [ 
                nodeNewField.data( 'type' ), // field type slug
                nodeNewField.attr( 'id' ),   // element tag id
                0, // call type // call type, 0 : repeatable fields, 1: repeatable sections, 2: nested repeatable fields.
                0, // section index - @todo find the section index
                0  // field index - @todo find the field index
            ]
        );
        
        
        // @deprecated 3.8.0 For the _nested field type, the above repeatable fields callback handles it.
        // For nested fields,
/*         $( nodeNewField ).find( '.custom-scrollbar-field' ).each( function( iIterationIndex ) {    
        
            // Rebind the click event to the repeatable field buttons - important to update AFTER inserting the clone to the document node 
            // since the update method needs to count fields.
            // @todo examine if this is needed any longer.
            $( this ).updateCustomScrollbar_AdminPageFrameworkRepeatableFields();
                                        
            // Call back the registered functions.
            $( this ).trigger( 
                'custom-scrollbar_repeated_field', 
                [ 
                    $( this ).data( 'type' ), 
                    nodeNewField.attr( 'id' ), // pass the parent field id
                    2,  // call type, 0 : repeatable sections, 1: repeatable fields, 2: nested repeatable fields.
                    0,  // @todo find the section index
                    iIterationIndex  // @todo find the nested field index
                ]
            );            
            
        });  */   
        
        // If more than one fields are created, show the Remove button.
// @todo find() may not be appropriate for nested fields.
        var nodeRemoveButtons = nodeFieldsContainer.find( '.repeatable-field-remove-button' );
        if ( nodeRemoveButtons.length > 1 ) { 
            nodeRemoveButtons.css( 'visibility', 'visible' ); 
        }

        // Display/hide delimiters.
        nodeFieldsContainer.children( '.custom-scrollbar-field' ).children( '.delimiter' ).show().last().hide();
        
        // Return the newly created element. The media uploader needs this 
        return nodeNewField; 
        
    };
    
        /**
         * Increments digits in field attributes.
         * @since       3.8.0
         */
        var _incrementFieldAttributes = function( oElement, oFieldsContainer ) {
                
            var _iFieldCount            = Number( oFieldsContainer.attr( 'data-largest_index' ) );
            var _iIncrementedFieldCount = _iFieldCount + 1;
            oFieldsContainer.attr( 'data-largest_index', _iIncrementedFieldCount );
         
            var _sFieldTagIDModel    = oFieldsContainer.attr( 'data-field_tag_id_model' );
            var _sFieldNameModel     = oFieldsContainer.attr( 'data-field_name_model' );
            var _sFieldFlatNameModel = oFieldsContainer.attr( 'data-field_name_flat_model' );
            var _sFieldAddressModel  = oFieldsContainer.attr( 'data-field_address_model' );

            oElement.incrementAttribute(
                'id', // attribute name
                _iFieldCount, // increment from
                _sFieldTagIDModel // digit model
            );
            oElement.find( 'label' ).incrementAttribute(
                'for', // attribute name
                _iFieldCount, // increment from
                _sFieldTagIDModel // digit model
            );
            oElement.find( 'input,textarea,select' ).incrementAttribute(
                'id', // attribute name
                _iFieldCount, // increment from
                _sFieldTagIDModel // digit model
            );       
            oElement.find( 'input,textarea,select' ).incrementAttribute(
                'name', // attribute name
                _iFieldCount, // increment from
                _sFieldNameModel // digit model
            );
            
            // Update the hidden input elements that contain field names for nested elements.
            oElement.find( 'input[type=hidden].element-address' ).incrementAttributes(
                [ 'name', 'value', 'data-field_address_model' ], // attribute names - these elements contain id values in the 'name' attribute.
                _iFieldCount,
                _sFieldAddressModel // digit model - this is
            );              
            
            // For checkbox, select, and radio input types
            oElement.find( 'input[type=radio][data-id],input[type=checkbox][data-id],select[data-id]' ).incrementAttribute(
                'data-id', // attribute name
                _iFieldCount, // increment from
                _sFieldTagIDModel // digit model
            );                
            
            // 3.8 For nested repeatable fields
            oElement.find( '.custom-scrollbar-field,.custom-scrollbar-fields,.custom-scrollbar-fieldset' ).incrementAttributes(
                [ 'id', 'data-field_tag_id_model', 'data-field_id' ],
                _iFieldCount,
                _sFieldTagIDModel
            );
            oElement.find( '.custom-scrollbar-fields' ).incrementAttributes(
                [ 'data-field_name_model' ],
                _iFieldCount,
                _sFieldNameModel
            );            
            oElement.find( '.custom-scrollbar-fields' ).incrementAttributes(
                [ 'data-field_name_flat', 'data-field_name_flat_model' ],
                _iFieldCount,
                _sFieldFlatNameModel
            );                 
            oElement.find( '.custom-scrollbar-fields' ).incrementAttributes(
                [ 'data-field_address', 'data-field_address_model' ],
                _iFieldCount,
                _sFieldAddressModel
            );            
// console.log( _sFieldTagIDModel );
// console.log( oElement.find( 'fieldset.custom-scrollbar-fieldset' ).length );
// console.log( oElement.find( 'fieldset.custom-scrollbar-fieldset' ).first().attr( 'id' ) );
            // oElement.find( 'fieldset.custom-scrollbar-fieldset' ).incrementAttributes(
                // [ 'id', 'data-field_id' ],           // attribute name
                // _iFieldCount,   // increment from
                // _sFieldTagIDModel
            // );
// console.log( oElement.find( 'fieldset.custom-scrollbar-fieldset' ).first().attr( 'id' ) );
            
        }    
        
    
    /**
     * Removes a repeatable field.
      This method is called when the user presses the - repeatable button.
     */
    $.fn.removeCustomScrollbar_AdminPageFrameworkRepeatableField = function() {
        
        /* Need to remove the element: the field container */
        var nodeFieldContainer  = $( this ).closest( '.custom-scrollbar-field' );
        var nodeFieldsContainer = $( this ).closest( '.custom-scrollbar-fields' );
        var _sFieldsContainerID = nodeFieldsContainer.attr( 'id' );
        
        /* If the set minimum number of fields already exists, do not remove */
        var sMinNumberOfFields  = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'min' ];
        if ( sMinNumberOfFields != 0 && nodeFieldsContainer.find( '.custom-scrollbar-field' ).length <= sMinNumberOfFields ) {
            var nodeLastRepeaterButtons = nodeFieldContainer.find( '.custom-scrollbar-repeatable-field-buttons' ).last();
            var sMessage                = $( this ).formatPrintText( '{$sCannotRemoveMore}', sMinNumberOfFields );
            var nodeMessage             = $( '<span class=\"repeatable-error repeatable-field-error\" id=\"repeatable-error-' + _sFieldsContainerID + '\">' + sMessage + '</span>' );
            if ( nodeFieldsContainer.find( '#repeatable-error-' + _sFieldsContainerID ).length > 0 ) {
                nodeFieldsContainer.find( '#repeatable-error-' + _sFieldsContainerID ).replaceWith( nodeMessage );
            } else {
                nodeLastRepeaterButtons.before( nodeMessage );
            }
            var _iFadeout = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'fadeout' ]
                ? $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'fadeout' ]
                : 500;
            nodeMessage.delay( 2000 ).fadeOut( _iFadeout );
            return;     
        }     
        
        /* Remove the field */
        var _iFadeout = $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'fadeout' ]
            ? $.fn.aCustomScrollbar_AdminPageFrameworkRepeatableFieldsOptions[ _sFieldsContainerID ][ 'fadeout' ]
            : 500;        
        nodeFieldContainer.fadeOut( _iFadeout, function() { 
            $( this ).remove(); 
            var nodeRemoveButtons = nodeFieldsContainer.find( '.repeatable-field-remove-button' );
            if ( 1 === nodeRemoveButtons.length ) { 
                nodeRemoveButtons.css( 'visibility', 'hidden' ); 
            }            
        } );
            
    };
        
}( jQuery ));    
JAVASCRIPTS;
        
    }
}
