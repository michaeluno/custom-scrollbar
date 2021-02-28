<?php 
/**
	Admin Page Framework v3.8.26 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_FieldType_textarea extends CustomScrollbar_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('textarea');
    protected $aDefaultKeys = array('rich' => false, 'attributes' => array('autofocus' => null, 'cols' => 60, 'disabled' => null, 'formNew' => null, 'maxlength' => null, 'placeholder' => null, 'readonly' => null, 'required' => null, 'rows' => 4, 'wrap' => null,),);
    public function getScripts() {
        $_aJSArray = json_encode($this->aFieldTypeSlugs);
        return <<<JAVASCRIPTS
jQuery( document ).ready( function(){
    
    // Move the link tag into the bottom of the page
    jQuery( 'link#editor-buttons-css' ).appendTo( '#wpwrap' );
    
    /**
     * Determines whether the callback is handleable or not.
     */
    var isEditorReady = function( oField, sFieldType ) {
     
        if ( jQuery.inArray( sFieldType, $_aJSArray ) <= -1 ) {
            return false
        }
                    
        // If tinyMCE is not ready, return.
        if ( 'object' !== typeof tinyMCEPreInit ){
            return;
        }
                            
        return true;
        
    };
        /**
         * @deprecated
         */
        var isHandleable = function() {
            return isEditorReady( oField, sFieldType );
        }
        
    /**
     * Removes the editor by the given textarea ID.
     */
    var removeEditor = function( sTextAreaID ) {

        if ( 'object' !== typeof tinyMCEPreInit ){
            return;
        }
     
        // Store the previous texatrea value. jQuery has a bug that val() for <textarea> does not work for cloned element. @see: http://bugs.jquery.com/ticket/3016
        var oTextArea       = jQuery( '#' + sTextAreaID );
        var sTextAreaValue  = oTextArea.val();
        
        // Delete the rich editor. Somehow this deletes the value of the textarea tag in some occasions.
        tinyMCE.execCommand( 'mceRemoveEditor', false, sTextAreaID );
        delete tinyMCEPreInit[ 'mceInit' ][ sTextAreaID ];
        delete tinyMCEPreInit[ 'qtInit' ][ sTextAreaID ];
        
        // Restore the previous textarea value
        oTextArea.val( sTextAreaValue );
    
    };
    
    /**
     * Updates the editor
     * 
     * @param   string  sTextAreaID     The textarea element ID without the sharp mark(#).
     */
    var updateEditor = function( sTextAreaID, oTinyMCESettings, oQickTagSettings ) {
        
        removeEditor( sTextAreaID );
        var aTMCSettings    = jQuery.extend( 
            {}, 
            oTinyMCESettings, 
            { 
                selector:       '#' + sTextAreaID,
                body_class:     sTextAreaID,
                height:         '100px',  
                menubar:        false,
                setup :         function( ed ) {    // see: http://www.tinymce.com/wiki.php/API3:event.tinymce.Editor.onChange
                    // It seems for tinyMCE 4 or above the on() method must be used.
                    if ( tinymce.majorVersion >= 4 ) {
                        ed.on( 'change', function(){                                           
                            jQuery( '#' + this.id ).val( this.getContent() );
                            jQuery( '#' + this.id ).html( this.getContent() );
                        });
                    } else {
                        // For tinyMCE 3.x or below the onChange.add() method needs to be used.
                        ed.onChange.add( function( ed, l ) {
                            // console.debug( ed.id + ' : Editor contents was modified. Contents: ' + l.content);
                            jQuery( '#' + ed.id ).val( ed.getContent() );
                            jQuery( '#' + ed.id ).html( ed.getContent() );
                        });
                    }
                },      
            }
        );   
        var aQTSettings     = jQuery.extend( {}, oQickTagSettings, { id : sTextAreaID } );    

        // Store the settings.
        tinyMCEPreInit.mceInit[ sTextAreaID ]   = aTMCSettings;
        tinyMCEPreInit.qtInit[ sTextAreaID ]    = aQTSettings;
        QTags.instances[ aQTSettings.id ]       = aQTSettings;
 
         // Enable quick tags
        quicktags( aQTSettings );   // does not work... See https://core.trac.wordpress.org/ticket/26183
        QTags._buttonsInit();
        
        window.tinymce.dom.Event.domLoaded = true;   
        tinyMCE.init( aTMCSettings );
        jQuery( this ).find( '.wp-editor-wrap' ).first().on( 'click.wp-editor', function() {
            if ( this.id ) {
                window.wpActiveEditor = this.id.slice( 3, -5 );
            }
        }); 

    };
    
    /**
     * Updates editors found in the passed elements. 
     * 
     * Called when fields are sorted to redraw the TinyMCE editor.
     */
    var updateFoundEditors = function( oElements ) {
        
        oElements.each( function( iIndex ) {
                                            
            // If the textarea tag is not found, do nothing.
            var oTextAreas = jQuery( this ).find( 'textarea.wp-editor-area' );
            if ( oTextAreas.length <= 0 ) {
                return true;
            }                    
            
            // Find the tinyMCE wrapper element
            var oWrap       = jQuery( this ).find( '.wp-editor-wrap' );
            if ( oWrap.length <= 0 ) {
                return true;
            }                                   

            // Retrieve the TinyMCE and Quick Tags settings. The enabler script stores the original element id.
            var oSettings = jQuery().getCustomScrollbar_AdminPageFrameworkInputOptions( oWrap.attr( 'data-id' ) );   

            var oTextArea           = jQuery( this ).find( 'textarea.wp-editor-area' ).first().show().removeAttr( 'aria-hidden' );
            var oEditorContainer    = jQuery( this ).find( '.wp-editor-container' ).first().clone().empty();
            var oToolBar            = jQuery( this ).find( '.wp-editor-tools' ).first().clone();
            
            // Replace the tinyMCE wrapper with the plain textarea tag element.
            oWrap.empty()
                .prepend( oEditorContainer.prepend( oTextArea.show() ) )
                .prepend( oToolBar );
            
            updateEditor( oTextArea.attr( 'id' ), oSettings['TinyMCE'], oSettings['QuickTags'] );

            // Switch the tab to the visual editor. This will trigger the switch action on the both of the tabs as clicking on only the Visual tab did not work.
            jQuery( this ).find( 'a.wp-switch-editor' ).trigger( 'click' );
                                                                
        });        
        
    };    
    
    /**
     * Decides whether the textarea element should be empty.
     */
    var shouldEmpty = function( iCallType, iIndex, iCountNextAll, iSectionIndex ) {

        // For repeatable fields,
        if ( 0 === iCallType ) {
           return ( 0 === iCountNextAll || 0 === iIndex )
        }

        // At this point, this is for repeatable sections. In this case, only the first iterated section should empty the fields.
        return ( 0 === iSectionIndex );
        
    };
    
    jQuery().registerCustomScrollbar_AdminPageFrameworkCallbacks( {	
        /**
         * Called when a field of this field type gets repeated.
         */
        repeated_field: function( oCloned, aModel ) {
                           
            // Return if not the type and there is no editor element.
            if ( ! isEditorReady( oCloned, aModel[ 'field_type' ] ) ) {
                return;
            }
            if ( oCloned.find( 'textarea.wp-editor-area' ).length <= 0 ) {
                return;
            }
            
            // Find the tinyMCE wrapper element
            var _oWrap     = oCloned.find( '.wp-editor-wrap' );
            if ( _oWrap.length <= 0 ) {
                return;
            }                      
                                  
            // TinyMCE and Quick Tags Settings - the enabler script stores the original element id.
            var _oSettings = jQuery().getCustomScrollbar_AdminPageFrameworkInputOptions( _oWrap.attr( 'data-id' ) );  

            // Elements
            var _oField              = oCloned.closest( '.custom-scrollbar-field' );
            var _oTextArea           = _oField.find( 'textarea.wp-editor-area' )
                .first()
                .clone() // Cloning is needed here as repeatable sections does not work with the original element for unknown reasons.
                .show()
                .removeAttr( 'aria-hidden' );
            var _oEditorContainer    = _oField.find( '.wp-editor-container' ).first().clone().empty();
            var _oToolBar            = _oField.find( '.wp-editor-tools' ).first().clone();
            
            // Clean values
            _oTextArea.val( '' );    // only delete the value of the directly copied one
            _oTextArea.empty();      // the above use of val( '' ) does not erase the value completely.
            
            // Replace the tinyMCE wrapper with the plain textarea tag element.
            _oWrap.empty()
                .prepend( _oEditorContainer.prepend( _oTextArea.show() ) )
                .prepend( _oToolBar );   

            // Update the editor. For repeatable sections, remove the previously assigned editor.                        
            updateEditor( 
                _oTextArea.attr( 'id' ), 
                _oSettings[ 'TinyMCE' ], 
                _oSettings[ 'QuickTags' ] 
            );
  
            // Update the TinyMCE editor and the Quick Tags bar and their attributes.
            _oToolBar.find( 'a,div,button' ).incrementAttributes(
                [ 'id', 'data-wp-editor-id', 'data-editor' ], // attribute name
                aModel[ 'incremented_from' ], // index incremented from
                aModel[ 'id' ] // digit model
            );
            _oField.find( '.wp-editor-wrap a' ).incrementAttribute(
                'data-editor',
                aModel[ 'incremented_from' ], // index incremented from
                aModel[ 'id' ] // digit model
            );
            _oField.find( '.wp-editor-wrap,.wp-editor-tools,.wp-editor-container' ).incrementAttribute(
                'id',
                aModel[ 'incremented_from' ], // index incremented from
                aModel[ 'id' ] // digit model
            );                     
            
        },    
        
        /**
         * The sortable field callback for the sort update event.
         * 
         * On contrary to repeatable fields callbacks, the _fields_ container element object and its ID will be passed.
         * 
         * @param object    oSortedFields   the sorted fields container element.
         * @param string    sFieldType      the field type slug
         * @param string    sFieldTagID     the field container tag ID
         * @param integer   iCallType       the caller type. 1 : repeatable sections. 0 : repeatable fields.
         */
        stopped_sorting_fields : function( oSortedFields, sFieldType, sFieldsTagID, iCallType ) { 

            if ( ! isEditorReady( oSortedFields, sFieldType ) ) {
                return;
            }                     
                        
            // Update the editor.
            setTimeout(function(){
                var _oFields = oSortedFields.children( '.custom-scrollbar-field' );
                updateFoundEditors( _oFields );
            }, 100 );
            
        },
        
        /**
         * Called when sortable sections stop sorting.
         */
        stopped_sorting_sections: function( oSections ) {

            setTimeout(function(){
                var _oFields = jQuery( oSections ).find( '.custom-scrollbar-field' );
                updateFoundEditors( _oFields );           
            }, 100 );
            
        },
        
        /**
         * The saved widget callback.
         * 
         * It is called when a widget is saved.
         */
        saved_widget : function( oWidget ) { 
        
             // If tinyMCE is not ready, return.
            if ( 'object' !== typeof tinyMCEPreInit ){
                return;
            }       

            var _sWidgetInitialTextareaID;
            jQuery( oWidget ).find( '.custom-scrollbar-field' ).each( function( iIndex ) {
                                            
                /* If the textarea tag is not found, do nothing  */
                var oTextAreas = jQuery( this ).find( 'textarea.wp-editor-area' );
                if ( oTextAreas.length <= 0 ) {
                    return true;
                }                    
                
                // Find the tinyMCE wrapper element
                var oWrap       = jQuery( this ).find( '.wp-editor-wrap' );
                if ( oWrap.length <= 0 ) {
                    return true;
                }                                   

                // Retrieve the TinyMCE and Quick Tags settings from the initial widget form element. The initial widget is the one from which the user drags.
                var oTextArea             = jQuery( this ).find( 'textarea.wp-editor-area' ).first(); // .show().removeAttr( 'aria-hidden' );
                var _sID                  = oTextArea.attr( 'id' );
                var _sInitialTextareaID   = _sID.replace( /(widget-.+-)([0-9]+)(-)/i, '$1__i__$3' );
                _sWidgetInitialTextareaID = 'undefined' === typeof  tinyMCEPreInit.mceInit[ _sInitialTextareaID ]
                    ? _sWidgetInitialTextareaID 
                    : _sInitialTextareaID;
                if ( 'undefined' === typeof  tinyMCEPreInit.mceInit[ _sWidgetInitialTextareaID ] ) {
                    return true;
                }
                
                updateEditor( 
                    oTextArea.attr( 'id' ), 
                    tinyMCEPreInit.mceInit[ _sWidgetInitialTextareaID ],
                    tinyMCEPreInit.qtInit[ _sWidgetInitialTextareaID ]
                );          

                // Store the settings.
                jQuery().storeCustomScrollbar_AdminPageFrameworkInputOptions( 
                    oWrap.attr( 'data-id' ), 
                    { 
                        TinyMCE:    tinyMCEPreInit.mceInit[ _sWidgetInitialTextareaID ],
                        QuickTags:  tinyMCEPreInit.qtInit[ _sWidgetInitialTextareaID ]
                    } 
                );                            
            });                                          
        
        } // end of 'saved_widget'
        
    },
    {$_aJSArray}
    );	        
});
JAVASCRIPTS;
        
    }
    protected function getStyles() {
        return ".custom-scrollbar-field-textarea .custom-scrollbar-input-label-string {vertical-align: top;margin-top: 2px;} .custom-scrollbar-field-textarea .wp-core-ui.wp-editor-wrap {margin-bottom: 0.5em;}.custom-scrollbar-field-textarea.custom-scrollbar-field .custom-scrollbar-input-label-container {vertical-align: top; float: left;clear: both;} .postbox .custom-scrollbar-field-textarea .custom-scrollbar-input-label-container {width: 100%;}.custom-scrollbar-field-textarea textarea {max-width: 100%;}";
    }
    protected function getField($aField) {
        $_aOutput = array();
        foreach (( array )$aField['label'] as $_sKey => $_sLabel) {
            $_aOutput[] = $this->_getFieldOutputByLabel($_sKey, $_sLabel, $aField);
        }
        $_aOutput[] = "<div class='repeatable-field-buttons'></div>";
        return implode('', $_aOutput);
    }
    private function _getFieldOutputByLabel($sKey, $sLabel, $aField) {
        $_bIsArray = is_array($aField['label']);
        $_sClassSelector = $_bIsArray ? 'custom-scrollbar-field-textarea-multiple-labels' : '';
        $_sLabel = $this->getElementByLabel($aField['label'], $sKey, $aField['label']);
        $aField['value'] = $this->getElementByLabel($aField['value'], $sKey, $aField['label']);
        $aField['rich'] = $this->getElementByLabel($aField['rich'], $sKey, $aField['label']);
        $aField['attributes'] = $_bIsArray ? array('name' => $aField['attributes']['name'] . "[{$sKey}]", 'id' => $aField['attributes']['id'] . "_{$sKey}", 'value' => $aField['value'],) + $aField['attributes'] : $aField['attributes'];
        $_aOutput = array($this->getElementByLabel($aField['before_label'], $sKey, $aField['label']), "<div class='custom-scrollbar-input-label-container {$_sClassSelector}'>", "<label for='" . $aField['attributes']['id'] . "'>", $this->getElementByLabel($aField['before_input'], $sKey, $aField['label']), $_sLabel ? "<span " . $this->getLabelContainerAttributes($aField, 'custom-scrollbar-input-label-string') . ">" . $_sLabel . "</span>" : '', $this->_getEditor($aField), $this->getElementByLabel($aField['after_input'], $sKey, $aField['label']), "</label>", "</div>", $this->getElementByLabel($aField['after_label'], $sKey, $aField['label']),);
        return implode('', $_aOutput);
    }
    private function _getEditor($aField) {
        unset($aField['attributes']['value']);
        if (empty($aField['rich']) || !$this->isTinyMCESupported()) {
            return "<textarea " . $this->getAttributes($aField['attributes']) . " >" . esc_textarea($aField['value']) . "</textarea>";
        }
        ob_start();
        wp_editor($aField['value'], $aField['attributes']['id'], $this->uniteArrays(( array )$aField['rich'], array('wpautop' => true, 'media_buttons' => true, 'textarea_name' => $aField['attributes']['name'], 'textarea_rows' => $aField['attributes']['rows'], 'tabindex' => '', 'tabfocus_elements' => ':prev,:next', 'editor_css' => '', 'editor_class' => $aField['attributes']['class'], 'teeny' => false, 'dfw' => false, 'tinymce' => true, 'quicktags' => true)));
        $_sContent = ob_get_contents();
        ob_end_clean();
        return $_sContent . $this->_getScriptForRichEditor($aField['attributes']['id']);
    }
    private function _getScriptForRichEditor($sIDSelector) {
        $_sScript = <<<JAVASCRIPTS
jQuery( document ).ready( function() {
                        
    // Store the textarea tag ID to be referred by the repeatable routines.
    jQuery( '#wp-{$sIDSelector}-wrap' ).attr( 'data-id', '{$sIDSelector}' );    // store the id
    if ( 'object' !== typeof tinyMCEPreInit ){ 
        return; 
    }
    
    // Store the settings.
    jQuery().storeCustomScrollbar_AdminPageFrameworkInputOptions( 
        '{$sIDSelector}', 
        { 
            TinyMCE: tinyMCEPreInit.mceInit[ '{$sIDSelector}' ], 
            QuickTags: tinyMCEPreInit.qtInit[ '{$sIDSelector}' ],
        } 
    );

})            
JAVASCRIPTS;
        return "<script type='text/javascript' class='custom-scrollbar-textarea-enabler'>" . '/* <![CDATA[ */' . $_sScript . '/* ]]> */' . "</script>";
    }
    }
    