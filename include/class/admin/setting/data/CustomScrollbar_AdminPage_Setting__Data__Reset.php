<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 */

/**
 * Adds the 'Reset' form section to the 'Data' tab.
 * 
 * @since        1.2.0
 */
class CustomScrollbar_AdminPage_Setting__Data__Reset extends CustomScrollbar_AdminPage_Section_Base {
    
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
                'field_id'          => 'reset_confirmation_check',
                'title'             => __( 'Initialization', 'custom-scrollbar' ),
                'type'              => 'checkbox',
                'label'             => __( 'I understand the options will be erased by pressing the reset button.', 'custom-scrollbar' ),
                'save'              => false,
                'value'             => false,
            ),            
            array(
                'field_id'          => 'reset',
                'type'              => 'submit',
                'reset'             => true,
                'save'              => false,
                'skip_confirmation' => true,
                'value'             => __( 'Reset', 'custom-scrollbar' ),
            ),            
            array()            
        );
    
    }
        
    
    /**
     * Validates the submitted form data.
     * 
     * @since        1
     */
    public function validate( $aInputs, $aOldInputs, $oAdminPage, $aSubmitInfo ) {
    
        $_bVerified = true;
        $_aErrors   = array();
        
        // If the pressed button is not the one with the check box, do not set a field error.
        if ( 'reset' !== $aSubmitInfo[ 'field_id' ] ) {
            return $aInputs;
        }

        if ( ! $aInputs[ 'reset_confirmation_check' ] ) {
            $_bVerified = false;
            $_aErrors[ $this->sSectionID ][ 'reset_confirmation_check' ] = __( 'Please check the check box to confirm you want to reset the settings.', 'custom-scrollbar' );
        }
        
        // An invalid value is found. Set a field error array and an admin notice and return the old values.
        if ( ! $_bVerified ) {
            $oAdminPage->setFieldErrors( $_aErrors );     
            $oAdminPage->setSettingNotice( __( 'There was something wrong with your Inputs.', 'custom-scrollbar' ) );
            return $aOldInputs;
        }
                
        return $aInputs;     
        
    }
   
}