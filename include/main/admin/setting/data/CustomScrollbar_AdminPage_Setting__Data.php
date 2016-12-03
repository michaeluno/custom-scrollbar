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
 * Adds the 'Data' tab to the 'Settings' page of the loader plugin.
 * 
 * @since       1.2.0
 * @extends     CustomScrollbar_AdminPage_Tab_Base
 */
class CustomScrollbar_AdminPage_Setting__Data extends CustomScrollbar_AdminPage_Tab_Base {
    
    /**
     * Triggered when the tab is loaded.
     */
    public function replyToLoadTab( $oAdminPage ) {
        
        // Form sections
        new CustomScrollbar_AdminPage_Setting__Data__Transport( 
            $oAdminPage,
            $this->sPageSlug, 
            array(
                'section_id'    => 'transport',
                'tab_slug'      => $this->sTabSlug,
                'title'         => __( 'Import / Export Options', 'custom-scrollbar' ),
            )
        );   
        new CustomScrollbar_AdminPage_Setting__Data__Reset( 
            $oAdminPage,
            $this->sPageSlug, 
            array(
                'section_id'    => 'reset',
                'tab_slug'      => $this->sTabSlug,
                'title'         => __( 'Reset Options', 'custom-scrollbar' ),
            )
        );
      
    }
    
    // public function replyToDoTab( $oFactory ) {
        // echo "<div class='right-submit-button'>"
                // . get_submit_button()  
            // . "</div>";
    // }
            
}
