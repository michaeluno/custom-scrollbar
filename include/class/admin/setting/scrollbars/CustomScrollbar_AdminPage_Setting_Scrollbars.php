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
 * Adds the 'Scrollbars' tab to the 'Settings' page of the loader plugin.
 * 
 * @since        1
 * @extends     CustomScrollbar_AdminPage_Tab_Base
 */
class CustomScrollbar_AdminPage_Setting_Scrollbars extends CustomScrollbar_AdminPage_Tab_Base {
    
    /**
     * Triggered when the tab is loaded.
     */
    public function replyToLoadTab( $oAdminPage ) {
        
        // Form sections
        new CustomScrollbar_AdminPage_Setting_Scrollbars_Scrollbars( 
            $oAdminPage,
            $this->sPageSlug, 
            array(
                'section_id'    => 'scrollbars',
                'tab_slug'      => $this->sTabSlug,
                'title'         => __( 'Scrollbars', 'custom-scrollbar' ),
                'description'   => array(
                    __( 'Define scrollbars.', 'custom-scrollbar' ),
                ),
                'collapsible'       => array(
                    'toggle_all_button' => array( 'top-left', 'bottom-left' ),
                    'container'         => 'section',
                    'is_collapsed'      => false,
                ),
                'repeatable'        => true, // this makes the section repeatable
                'sortable'          => true,
            )
        );
      
    }
    
    public function replyToDoTab( $oFactory ) {
        $_sImageURL = CustomScrollbar_Registry::getPluginURL( '/asset/image/scrollbar_parts_names.png' );
        echo "<img class='scroll-bar-parts' src='{$_sImageURL}' />";
        echo "<div class='right-submit-button'>"
                . get_submit_button()  
            . "</div>";
    }
            
}
