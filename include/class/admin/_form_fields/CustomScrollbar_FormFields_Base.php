<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015 Michael Uno
 * 
 */

/**
 * Provides abstract methods for form fields.
 * 
 * @since       1
 */
abstract class CustomScrollbar_FormFields_Base extends CustomScrollbar_WPUtility {

    /**
     * Stores the option object.
     */
    public $oOption;
    

    public function __construct() {
        
        $this->oOption         = CustomScrollbar_Option::getInstance();
        
    }
    
    /**
     * Should be overridden in an extended class.
     * 
     * @remark      Do not even declare this method as parameters will be vary 
     * and if they are different PHP will throw errors.
     */
    // public function get() {}
  
}