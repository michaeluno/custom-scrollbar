<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno
 * 
 */


/**
 * Deals with the plugin admin pages.
 * 
 * @since       1
 */
class CustomScrollbar_AdminPage extends CustomScrollbar_AdminPageFramework {

    /**
     * User constructor.
     */
    public function start() {
        
        if ( ! $this->oProp->bIsAdmin ) {
            return;
        }     
        add_filter( 
            "options_" . $this->oProp->sClassName,
            array( $this, 'replyToSetOptions' )
        );
        
    }
        /**
         * Sets the default option values for the setting form.
         * @return      array       The options array.
         */
        public function replyToSetOptions( $aOptions ) {
            $_oOption    = CustomScrollbar_Option::getInstance();
            return $aOptions + $_oOption->aDefault;            
        }
        
    /**
     * Sets up admin pages.
     */
    public function setUp() {
        
        $this->setRootMenuPage( 'Appearance' );
                    
        // Add pages      
        new CustomScrollbar_AdminPage_Setting( 
            $this,
            array(
                'page_slug'     => CustomScrollbar_Registry::$aAdminPages[ 'setting' ],
                'title'         => __( 'Scrollbars', 'custom-scrollbar' ),
                // 'screen_icon'   => CustomScrollbar_Registry::getPluginURL( "asset/image/screen_icon_32x32.png" ),
            )
        );

        $this->_doPageSettings();
        
    }

        /**
         * Page styling
         * @since        1
         * @return      void
         */
        private function _doPageSettings() {
                        
            $this->setPageTitleVisibility( false ); // disable the page title of a specific page.
            $this->setInPageTabTag( 'h2' );                
            // $this->setPluginSettingsLinkLabel( '' ); // pass an empty string to disable it.
            
            $this->enqueueStyle( CustomScrollbar_Registry::getPluginURL( 'asset/css/admin.css' ) );
        
        }

}