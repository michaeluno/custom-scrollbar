<?php
abstract class CustomScrollbar_AdminPageFramework_Generate_Base extends CustomScrollbar_AdminPageFramework_WPUtility {
    public $aArguments = array();
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aArguments,);
        $this->aArguments = $_aParameters[0];
    }
    public function get() {
        return '';
    }
}