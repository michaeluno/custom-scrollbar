<?php
class CustomScrollbar_AdminPageFramework_FormPart_DebugInfo extends CustomScrollbar_AdminPageFramework_FormPart_Base {
    public $sFieldsType = '';
    public function __construct() {
        $_aParameters = func_get_args() + array($this->sFieldsType,);
        $this->sFieldsType = $_aParameters[0];
    }
    public function get() {
        if (!$this->isDebugModeEnabled()) {
            return '';
        }
        if (!in_array($this->sFieldsType, array('widget', 'post_meta_box', 'page_meta_box', 'user_meta'))) {
            return '';
        }
        return "<div class='custom-scrollbar-info'>" . 'Debug Info: ' . CustomScrollbar_AdminPageFramework_Registry::NAME . ' ' . CustomScrollbar_AdminPageFramework_Registry::getVersion() . "</div>";
    }
}