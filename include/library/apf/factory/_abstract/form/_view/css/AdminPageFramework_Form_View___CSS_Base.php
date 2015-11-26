<?php
class CustomScrollbar_AdminPageFramework_Form_View___CSS_Base extends CustomScrollbar_AdminPageFramework_WPUtility {
    public $aAdded = array();
    public function add($sCSSRules) {
        $this->aAdded[] = $sCSSRules;
    }
    public function get() {
        $_sCSSRules = $this->_get() . PHP_EOL;
        $_sCSSRules.= $this->_getVersionSpecific();
        $_sCSSRules.= implode(PHP_EOL, $this->aAdded);
        return $this->isDebugMode() ? trim($_sCSSRules) : $this->minifyCSS($_sCSSRules);
    }
    protected function _get() {
        return '';
    }
    protected function _getVersionSpecific() {
        return '';
    }
}