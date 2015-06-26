<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno
 * 
 */

/**
 * Inserts custom CSS rules.
 * 
 * @since       1
 */
class CustomScrollbar_ScriptLoader extends CustomScrollbar_PluginUtility {
    
    /**
     * 
     */
    public $aScrollbars = array();
    public $oOption;
    
    /**
     * Sets up properties and hooks
     */
    public function __construct() {
        
        if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
            return;
        }
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return;
        }
        
        $this->oOption     = CustomScrollbar_Option::getInstance();
        $this->aScrollbars = $this->getAsArray( $this->oOption->get( 'scrollbars' ) );
        $this->aScrollbars = $this->_getFormattedScrollbarOptions(
            $this->aScrollbars
        );

        if ( count( $this->aScrollbars ) <= 0 ) {
            return;
        }        
        add_action( 'wp_enqueue_scripts', array( $this, 'replyToEnqueueScripts' ) );
        
    } 
        /**
         * @remark      Drops items with the Off status.
         * @return      array
         */
        private function _getFormattedScrollbarOptions( array $aScrollbars ) {
            foreach( $aScrollbars as $_iIndex => &$_aScrollbar ) {
                $_aScrollbar = $_aScrollbar + $this->oOption->aDefault[ 'scrollbars' ][ 0 ];
                if ( ! $_aScrollbar[ 'status' ] ) {
                    unset( $aScrollbars[ $_iIndex ] );
                }
            }
            return $aScrollbars;
        }
    /**
     * @callback        action      wp_enqueue_scripts
     */
    public function replyToEnqueueScripts() {

        wp_enqueue_style( 
            'malihu-custom-scrollbar-css',     // handle id
            CustomScrollbar_Registry::getPluginURL( 
                $this->oOption->isDebug()
                    ? '/asset/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css' 
                    : '/asset/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css' 
            ) // file url
        );
      
        wp_enqueue_script( 
            'malihu-custom-scrollbar',     // handle id
            CustomScrollbar_Registry::getPluginURL( 
                $this->oOption->isDebug()
                    ? '/asset/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js' 
                    : '/asset/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js' 
            ), // file url            
            array( 'jquery' ),   // dependencies
            '',     // version
            true    // in footer? yes
        );
        wp_enqueue_script( 
            'custom_scrollbar_enabler',     // handle id
            CustomScrollbar_Registry::getPluginURL( '/asset/js/custom-scrollbar-enabler.js' ), // script url
            array( 'malihu-custom-scrollbar' ),   // dependencies
            '',     // version
            true    // in footer? yes
        );
        wp_localize_script( 
            'custom_scrollbar_enabler',  // handle id - the above used enqueue handl id
            'custom_scrollbar_enabler',  // name of the data loaded in the script
            $this->aScrollbars // translation array
        );         
        
    }
 
    
}