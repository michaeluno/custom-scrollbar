<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno
 * 
 */


/**
 * Provides common methods for simple wizard form pages.
 * 
 * @since        1
 */
abstract class CustomScrollbar_SimpleWizardAdminPage extends CustomScrollbar_AdminPageFramework {

    /**
     * User constructor.
     */
    public function start() {
        
        if ( ! $this->oProp->bIsAdmin ) {
            return;
        }     
        add_filter( 
            "options_" . $this->oProp->sClassName,
            array( $this, 'setOptions' )
        );
        add_action( 
            "set_up_" . $this->oProp->sClassName,
            array( $this, 'registerFieldTypes' )
        );
        add_action( 
            "set_up_" . $this->oProp->sClassName,
            array( $this, 'doPageSettings' )
        );        
        
        $this->setPluginSettingsLinkLabel( '' ); // pass an empty string to disable it.           
        
    }
    
    /**
     * Sets the default option values for the setting form.
     * @callback    filter      `options_{class name}`
     * @return      array       The options array.
     */
    public function setOptions( $aOptions ) {
        return $aOptions;
    }
    
    /**
     * @return      boolean
     */
    protected function isUserClickedAddNewLink( $sPostTypeSlug ) {
        if ( 'post-new.php' !== $GLOBALS['pagenow'] ) {
            return false;
        }
        if ( 1 !== count( $_GET ) ) {
            return false;
        }
        if ( ! isset( $_GET[ 'post_type' ] ) ) {
            return false;
        }
        return $sPostTypeSlug === $_GET[ 'post_type' ];            
    }
        
    /**
     * Registers custom filed types of Admin Page Framework.
     */
    public function registerFieldTypes() {
        
        // @deprecated
        // new AmazonPAAPIAuthFieldType( 'CustomScrollbar_AdminPage' );
        
    }
    /**
     * Page styling
     * @since        1
     * @return      void
     */
    public function doPageSettings() {}
        
}