<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno
 * 
 */

/**
 * Handles plugin options.
 * 
 * @since       1
 */
class CustomScrollbar_Option extends CustomScrollbar_Option_Base {

    /**
     * Stores instances by option key.
     * 
     * @since        1
     */
    static public $aInstances = array(
        // key => object
    );
        
    /**
     * Stores the default values.
     */
    public $aDefault = array(
    
        'reset'    => array(
            'reset_on_uninstall'    => false,
        ),
        
        'css'       => array(
            'custom_css' => '',
        ),
        
        'scrollbars' => array(
            0   => array(
                'status'    => true,    // or false
                'name'      => '', // just a label for the user to remember
                'selector'  => '',
                'width'     => array(
                    'size'  => null,
                    'unit'  => null,
                ),
                'height'    => array(
                    'size'  => null,
                    'unit'  => null,
                ),     
                'position'  => 'inside', // or outside
                
                'inline_css'    => array(), // 1.1+ 
                
                // @see http://manos.malihu.gr/repository/custom-scrollbar/demo/examples/scrollbar_themes_demo.html
                'theme'     => 'light', 
                
                // custom colors
                'mCSB_draggerContainer' => '',
                'mCSB_dragger'          => '',
                'mCSB_dragger_bar'      => '',
                'mCSB_draggerRail'      => '',
                'mCSB_scrollTools'      => '',
                
            ),
        ),
    );
         
    /**
     * Returns the instance of the class.
     * 
     * This is to ensure only one instance exists.
     * 
     * @since      3
     */
    static public function getInstance( $sOptionKey='' ) {
        
        $sOptionKey = $sOptionKey 
            ? $sOptionKey
            : CustomScrollbar_Registry::$aOptionKeys[ 'setting' ];
        
        if ( isset( self::$aInstances[ $sOptionKey ] ) ) {
            return self::$aInstances[ $sOptionKey ];
        }
        $_sClassName = apply_filters( 
            CustomScrollbar_Registry::HOOK_SLUG . '_filter_option_class_name',
            __CLASS__ 
        );
        self::$aInstances[ $sOptionKey ] = new $_sClassName( $sOptionKey );
        return self::$aInstances[ $sOptionKey ];
        
    }         
        
    /**
     * Checks whether the plugin debug mode is on or not.
     * @return      boolean
     */ 
    public function isDebug() {
        return defined( 'WP_DEBUG' ) && WP_DEBUG;
    }
    
}