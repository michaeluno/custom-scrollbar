<?php 
/**
	Admin Page Framework v3.8.7b02 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
abstract class CustomScrollbar_AdminPageFramework_Format_Base extends CustomScrollbar_AdminPageFramework_FrameworkUtility {
    static public $aStructure = array();
    public $aSubject = array();
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aSubject,);
        $this->aSubject = $_aParameters[0];
    }
    public function get() {
        return $this->aSubject;
    }
}
