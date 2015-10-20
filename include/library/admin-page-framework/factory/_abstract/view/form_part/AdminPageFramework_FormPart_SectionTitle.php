<?php
class CustomScrollbar_AdminPageFramework_FormPart_SectionTitle extends CustomScrollbar_AdminPageFramework_FormPart_Base {
    public $sTitle = '';
    public $sTag = '';
    public $aFields = array();
    public $hfFieldCallback = null;
    public $iSectionIndex = null;
    public $aFieldTypeDefinitions = array();
    public function __construct() {
        $_aParameters = func_get_args() + array($this->sTitle, $this->sTag, $this->aFields, $this->hfFieldCallback, $this->iSectionIndex,);
        $this->sTitle = $_aParameters[0];
        $this->sTag = $_aParameters[1];
        $this->aFields = $_aParameters[2];
        $this->hfFieldCallback = $_aParameters[3];
        $this->iSectionIndex = $_aParameters[4];
        $this->aFieldTypeDefinitions = $_aParameters[5];
    }
    public function get() {
        return $this->_getSectionTitle($this->sTitle, $this->sTag, $this->aFields, $this->hfFieldCallback, $this->iSectionIndex);
    }
    protected function _getSectionTitle($sTitle, $sTag, $aFields, $hfFieldCallback, $iSectionIndex = null, $aFieldTypeDefinitions = array()) {
        $_aSectionTitleField = $this->_getSectionTitleField($aFields, $iSectionIndex, $aFieldTypeDefinitions);
        return $_aSectionTitleField ? call_user_func_array($hfFieldCallback, array($_aSectionTitleField)) : "<{$sTag}>" . $sTitle . "</{$sTag}>";
    }
    private function _getSectionTitleField(array $aFieldsets, $iSectionIndex, $aFieldTypeDefinitions) {
        foreach ($aFieldsets as $_aFieldset) {
            if ('section_title' === $_aFieldset['type']) {
                $_oFieldsetOutputFormatter = new CustomScrollbar_AdminPageFramework_Format_FieldsetOutput($_aFieldset, $iSectionIndex, $aFieldTypeDefinitions);
                return $_oFieldsetOutputFormatter->get();
            }
        }
    }
}