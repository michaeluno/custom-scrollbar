<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 */

/**
 * Adds the 'Transport' form section to the 'Data' tab.
 * 
 * @since        1.2.0
 */
class CustomScrollbar_AdminPage_Setting__Data__Transport extends CustomScrollbar_AdminPage_Section_Base {
    
    /**
     * A user constructor.
     * 
     * @since       1.2.0
     * @return      void
     */
    protected function construct( $oFactory ) {}
    
    /**
     * Adds form fields.
     * @since       1.2.0
     * @return      void
     */
    public function addFields( $oFactory, $sSectionID ) {
    
        $_oOption = CustomScrollbar_Option::getInstance();    
        $oFactory->addSettingFields(
            $sSectionID, // the target section id
            array(
                'field_id'          => 'export',
                'type'              => 'export',
                'title'             => __( 'Export', 'custom-scrollbar' ),               
            ),       
            array(
                'field_id'          => 'import',
                'type'              => 'import',
                'title'             => __( 'Import', 'custom-scrollbar' ),               
                'value'             => __( 'Import', 'custom-scrollbar' ),               
            ),              
            array()            
        );
    
    }
        
    
    /**
     * Validates the submitted form data.
     * 
     * @since        1.2.0
     */
    public function validate( $aInputs, $aOldInputs, $oAdminPage, $aSubmitInfo ) {
    
        $_bVerified = true;
        $_aErrors   = array();
        
        
        // An invalid value is found. Set a field error array and an admin notice and return the old values.
        if ( ! $_bVerified ) {
            $oAdminPage->setFieldErrors( $_aErrors );     
            $oAdminPage->setSettingNotice( __( 'There was something wrong with your Inputs.', 'custom-scrollbar' ) );
            return $aOldInputs;
        }
                
        return $aInputs;     
        
    }
   
}