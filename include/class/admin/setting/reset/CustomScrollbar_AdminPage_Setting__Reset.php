<?php
/**
 * Custom Scrollbar
 * 
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015-2016 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Adds the 'General' tab to the 'Settings' page of the loader plugin.
 * 
 * @since       1.2.0
 * @extends     CustomScrollbar_AdminPage_Tab_Base
 */
class CustomScrollbar_AdminPage_Setting__Reset extends CustomScrollbar_AdminPage_Tab_Base {
    
    /**
     * Triggered when the tab is loaded.
     */
    public function replyToLoadTab( $oAdminPage ) {
        
        // Form sections
        
        new CustomScrollbar_AdminPage_Setting__Reset__Reset( 
            $oAdminPage,
            $this->sPageSlug, 
            array(
                'section_id'    => 'reset',
                'tab_slug'      => $this->sTabSlug,
                'title'         => __( 'Reset', 'custom-scrollbar' ),
            )
        );
      
    }
    
    // public function replyToDoTab( $oFactory ) {
        // echo "<div class='right-submit-button'>"
                // . get_submit_button()  
            // . "</div>";
    // }
            
}
