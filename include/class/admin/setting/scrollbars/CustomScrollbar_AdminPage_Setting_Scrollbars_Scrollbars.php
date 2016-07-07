<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 */

/**
 * Adds the 'Scrollbars' form section to the 'Scrollbars' tab.
 * 
 * @since        1
 */
class CustomScrollbar_AdminPage_Setting_Scrollbars_Scrollbars extends CustomScrollbar_AdminPage_Section_Base {
    
    /**
     * A user constructor.
     * 
     * @since        1
     * @return      void
     */
    protected function construct( $oFactory ) {}
    
    /**
     * Adds form fields.
     * @since       1
     * @return      void
     */
    public function addFields( $oFactory, $sSectionID ) {

        $oFactory->addSettingFields(
            $sSectionID, // the target section id
            array(
                'field_id'         => 'name',
                'type'             => 'section_title',
                'before_input'     => "<strong>"
                    . __( 'Name', 'custom-scrollbar' ) 
                    . "</strong>:&nbsp; ",
                'attributes'       => array(              
                    'size'          => 48,
                    'style'         => 'width: auto;',
                    'placeholder'   => __( 'Enter a scrollbar name', 'custom-scrollbar' ),
                ),
            ),   
            array(
                'field_id'         => 'status',
                'type'             => 'radio',
                'label'            => array(
                    1    => __( 'On', 'custom-scrollbar' ),
                    0    => __( 'Off', 'custom-scrollbar' ),
                ),
                'default'          => 1,
                'placement'        => 'section_title',
                'label_min_width'  => 40,
            ),                        
            array(
                'field_id'         => 'selector',
                'type'             => 'text',
                'title'            => __( 'Target Element Selector', 'custom-scrollbar' ),
                'tip'              => "<p>"
                        . __( 'Define the CSS (jQuery) target selector of the element.', 'custom-scrollbar' )
                        . ' e.g. <code>aside.widget</code>'
                    . "</p>"
                    . "<p>"
                        . __( 'For multiple selectors, delimit them by commas.', 'custom-scrollbar' )
                        . ' e.g. <code>div.widget > ul, div.widget > div</code>'
                    . "</p>",
                'attributes'       => array(
                    'size'  => 52,
                ),
            ),
            array(
                'field_id'          => 'height',
                'type'              => 'size',
                'title'             => __( 'Element Height', 'custom-scrollbar' ),
                'tip'               => __( 'The target element maximum height.', 'custom-scrollbar' )
                    . ' ' . __( 'HTMNL elements that exceed this value will have a scrollbar.', 'custom-scrollbar' ),
                'units'             => array(
                    'px'    => 'px',
                    '%'    => '%',
                ),
            ),
            array(
                'field_id'          => 'width',
                'type'              => 'size',
                'title'             => __( 'Element Width', 'custom-scrollbar' ),
                'tip'               => __( 'The target element maximum width.', 'custom-scrollbar' )
                    . ' ' . __( 'HTMNL elements that exceed this value will have a scrollbar.', 'custom-scrollbar' ),
                'units'             => array(
                    'px'    => 'px',
                    '%'    => '%',
                ),
            ),            
            array(
                'field_id'          => 'position',
                'type'              => 'radio',
                'title'             => __( 'Position', 'custom-scrollbar' ),
                'label'             => array(
                    'inside'     => 'inside',
                    'outside'    => 'outside',
                ),
                'default'           => 'inside',
            ),    
            array(
                'field_id'          => 'inline_css',
                'type'              => 'text',
                'title'             => __( 'Inline CSS', 'custom-scrollbar' ),
                'label'             => array(
                    'property' => __( 'Property', 'custom-scrollbar' ),
                    'value'    => __( 'Value', 'custom-scrollbar' ),
                ),
                'attributes'        => array(
                    'field' => array(
                        'style' => 'width: 100%;'
                    ),
                ),
                'tip'               => "<p>"
                        . __( 'Apply these inline CSS rules to the target elements.', 'custom-scrollbar' )
                        . ' e.g. ' . '<code>white-space</code>: <code>nowrap</code>'
                    . "</p>",
                'repeatable'        => true,
            ),               
            array(
                'field_id'          => 'theme',
                'type'              => 'select',
                'title'             => __( 'Theme', 'custom-scrollbar' ),
                'label'             => array(
                    'light'                 => __( 'Light', 'custom-scrollbar' ),
                    'dark'                  => __( 'Dark', 'custom-scrollbar' ),
                    'minimal'               => __( 'Minimal', 'custom-scrollbar' ),
                    'minimal-dark'          => __( 'Minimal-Dark', 'custom-scrollbar' ),
                    'light-2'               => __( 'Light 2', 'custom-scrollbar' ),
                    'dark-2'                => __( 'Dark 2', 'custom-scrollbar' ),
                    'light-3'               => __( 'Light 3', 'custom-scrollbar' ),
                    'dark-3'                => __( 'Dark 3', 'custom-scrollbar' ),
                    'light-thick'           => __( 'Light Thick', 'custom-scrollbar' ),
                    'dark-thick'            => __( 'Dark Thick', 'custom-scrollbar' ),
                    'light-thin'            => __( 'Light thin', 'custom-scrollbar' ),
                    'dark-thin'             => __( 'Dark thin', 'custom-scrollbar' ),
                    'inset'                 => __( 'Inset', 'custom-scrollbar' ),
                    'inset-dark'            => __( 'Inset-Dark', 'custom-scrollbar' ),
                    'inset-2'               => __( 'Inset 2', 'custom-scrollbar' ),
                    'inset-2-dark'          => __( 'Inset 2 Dark', 'custom-scrollbar' ),
                    'inset-3'               => __( 'Inset 3', 'custom-scrollbar' ),
                    'inset-3-dark'          => __( 'Inset 3 Dark', 'custom-scrollbar' ),
                    'rounded'               => __( 'Rounded', 'custom-scrollbar' ),
                    'rounded-dark'          => __( 'Rounded Dark', 'custom-scrollbar' ),
                    'rounded-dots'          => __( 'Rounded Dots', 'custom-scrollbar' ),
                    'rounded-dots-dark'     => __( 'Rounded Dots Dark', 'custom-scrollbar' ),
                    '3d'                    => __( '3D', 'custom-scrollbar' ),
                    '3d-dark'               => __( '3D Dark', 'custom-scrollbar' ),
                    '3d-thick'              => __( '3D Thick', 'custom-scrollbar' ),
                    '3d-thick-dark'         => __( '3D Thick Dark', 'custom-scrollbar' ),
                ),
                'default'           => 'light',
            ),   
            array(
                'field_id'          => 'mCSB_draggerContainer',
                'type'              => 'color',
                'title'             => '.mCSB_draggerContainer',
                'default'           => '',
            ),         
            array(
                'field_id'          => 'mCSB_dragger',
                'type'              => 'color',
                'title'             => '.mCSB_dragger',
                'default'           => '',
            ),            
            array(
                'field_id'          => 'mCSB_dragger_bar',
                'type'              => 'color',
                'title'             => '.mCSB_dragger_bar',
                'default'           => '',
            ),
            array(
                'field_id'          => 'mCSB_draggerRail',
                'type'              => 'color',
                'title'             => '.mCSB_draggerRail',
                'default'           => '',
            ),            
            array(
                'field_id'          => 'mCSB_scrollTools',
                'type'              => 'color',
                'title'             => '.mCSB_scrollTools',
                'default'           => '',
            ),            
            array()            
        );
    
    }
        
    
    /**
     * Validates the submitted form data.
     * 
     * @since        1
     */
    public function validate( $aInput, $aOldInput, $oAdminPage, $aSubmitInfo ) {
    
        $_bVerified = true;
        $_aErrors   = array();
        
        // An invalid value is found. Set a field error array and an admin notice and return the old values.
        if ( ! $_bVerified ) {
            $oAdminPage->setFieldErrors( $_aErrors );     
            $oAdminPage->setSettingNotice( __( 'There was something wrong with your input.', 'custom-scrollbar' ) );
            return $aOldInput;
        }
                
        return $aInput;     
        
    }
   
}