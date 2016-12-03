<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015-2016 Michael Uno; Licensed GPLv2
 */

/**
 * Adds the 'Reset' form section to the 'General' tab.
 * 
 * @since        1
 */
class CustomScrollbar_AdminPage_Setting__General__Reset extends CustomScrollbar_AdminPage_Section_Base {
    
    /**
     * A user constructor.
     * 
     * @since       1
     * @return      void
     */
    protected function construct( $oFactory ) {}
    
    /**
     * Adds form fields.
     * @since       1
     * @return      void
     */
    public function addFields( $oFactory, $sSectionID ) {
    
        $_oOption = CustomScrollbar_Option::getInstance();    
        $oFactory->addSettingFields(
            $sSectionID, // the target section id        
            array(
                'field_id'          => 'reset_on_uninstall',
                'type'              => 'checkbox',
                'title'             => __( 'On Uninstall', 'custom-scrollbar' ),
                'label'             => __( 'Delete options upon plugin uninstall.', 'custom-scrollbar' ),
            ),
            array()            
        );
    
    }
        
    
    /**
     * Validates the submitted form data.
     * 
     * @since        1
     */
    public function validate( $aInput, $aOldInput, $oAdminPage, $aSubmitInfo ) {
    
        $_bVerified = true;
        $_aErrors   = array();
        
        // An invalid value is found. Set a field error array and an admin notice and return the old values.
        if ( ! $_bVerified ) {
            $oAdminPage->setFieldErrors( $_aErrors );     
            $oAdminPage->setSettingNotice( __( 'There was something wrong with your input.', 'custom-scrollbar' ) );
            return $aOldInput;
        }
                
        return $aInput;     
        
    }
   
}