<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Adds the `Settings` page.
 * 
 * @since        1
 */
class CustomScrollbar_AdminPage_Setting extends CustomScrollbar_AdminPage_Page_Base {


    /**
     * A user constructor.
     * 
     * @since        1
     * @return      void
     */
    public function construct( $oFactory ) {
        
        // Tabs
        new CustomScrollbar_AdminPage_Setting_Scrollbars( 
            $this->oFactory,
            $this->sPageSlug,
            array( 
                'tab_slug'  => 'scrollbars',
                'title'     => __( 'Scrollbars', 'custom-scrollbar' ),
            )
        );        
        new CustomScrollbar_AdminPage_Setting_CSS(
            $this->oFactory,
            $this->sPageSlug,
            array( 
                'tab_slug'  => 'css',
                'title'     => __( 'Custom CSS', 'custom-scrollbar' ),
            )        
        );
        
        new CustomScrollbar_AdminPage_Setting_General( 
            $this->oFactory,
            $this->sPageSlug,
            array( 
                'tab_slug'  => 'general',
                'title'     => __( 'General', 'custom-scrollbar' ),
            )
        );

    }   
    
    /**
     * Prints debug information at the bottom of the page.
     */
    public function replyToDoAfterPage( $oFactory ) {
            
        $_oOption = CustomScrollbar_Option::getInstance();
        if ( ! $_oOption->isDebug() ) {
            return;
        }
        echo "<h3 style='display:block; clear:both;'>" 
                . __( 'Debug Info', 'custom-scrollbar' ) 
            .  "</h3>";
        $oFactory->oDebug->dump( $oFactory->getValue() );
        
    }
        
}
