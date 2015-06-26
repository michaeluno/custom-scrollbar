<?php
/**
 * Custom Scrollbar
 * 
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Adds the 'CSS' tab to the 'Scrollbars' page of the loader plugin.
 * 
 * @since       1
 * @extends     CustomScrollbar_AdminPage_Tab_Base
 */
class CustomScrollbar_AdminPage_Setting_CSS extends CustomScrollbar_AdminPage_Tab_Base {
    
    /**
     * Triggered when the tab is loaded.
     */
    public function replyToLoadTab( $oAdminPage ) {
        
        // Form sections
        new CustomScrollbar_AdminPage_Setting_CSS_CSS( 
            $oAdminPage,
            $this->sPageSlug, 
            array(
                'section_id'    => 'css',
                'tab_slug'      => $this->sTabSlug,
                'title'         => __( 'Custom CSS', 'custom-scrollbar' ),
                'description'   => array(
                    __( 'Define custom CSS.', 'custom-scrollbar' ),
                ),
            )
        );
      
    }
    
    public function replyToDoTab( $oFactory ) {
        echo "<div class='right-submit-button'>"
                . get_submit_button()  
            . "</div>";
    }
            
}
