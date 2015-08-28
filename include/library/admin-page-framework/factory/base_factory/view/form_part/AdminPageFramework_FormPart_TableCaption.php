<?php
class CustomScrollbar_AdminPageFramework_FormPart_TableCaption extends CustomScrollbar_AdminPageFramework_FormPart_Base {
    public $aSection = array();
    public $hfSectionCallback = null;
    public $iSectionIndex = null;
    public $aFields = array();
    public $hfFieldCallback = null;
    public $aFieldErrors = array();
    public $aFieldTypeDefinitions = array();
    public $oMsg = null;
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aSection, $this->hfSectionCallback, $this->iSectionIndex, $this->aFields, $this->hfFieldCallback, $this->aFieldErrors, $this->aFieldTypeDefinitions, $this->oMsg,);
        $this->aSection = $_aParameters[0];
        $this->hfSectionCallback = $_aParameters[1];
        $this->iSectionIndex = $_aParameters[2];
        $this->aFields = $_aParameters[3];
        $this->hfFieldCallback = $_aParameters[4];
        $this->aFieldErrors = $_aParameters[5];
        $this->aFieldTypeDefinitions = $_aParameters[6];
        $this->oMsg = $_aParameters[7];
    }
    public function get() {
        return $this->_getCaption($this->aSection, $this->hfSectionCallback, $this->iSectionIndex, $this->aFields, $this->hfFieldCallback, $this->aFieldErrors, $this->aFieldTypeDefinitions, $this->oMsg);
    }
    private function _getCaption(array $aSection, $hfSectionCallback, $iSectionIndex, $aFields, $hfFieldCallback, $aFieldErrors, $aFieldTypeDefinitions, $oMsg) {
        if (!$aSection['description'] && !$aSection['title']) {
            return "<caption class='admin-page-framework-section-caption' style='display:none;'></caption>";
        }
        $_oArgumentFormater = new CustomScrollbar_AdminPageFramework_Format_CollapsibleSection($aSection['collapsible'], $aSection['title'], $aSection);
        $_abCollapsible = $_oArgumentFormater->get();
        $_oCollapsibleSectionTitle = new CustomScrollbar_AdminPageFramework_FormPart_CollapsibleSectionTitle(isset($_abCollapsible['title']) ? $_abCollapsible['title'] : $aSection['title'], 'h3', $aFields, $hfFieldCallback, $iSectionIndex, $aFieldTypeDefinitions, $_abCollapsible, 'section', $oMsg);
        $_bShowTitle = empty($_abCollapsible) && !$aSection['section_tab_slug'];
        return "<caption " . $this->generateAttributes(array('class' => 'admin-page-framework-section-caption', 'data-section_tab' => $aSection['section_tab_slug'],)) . ">" . $_oCollapsibleSectionTitle->get() . $this->getAOrB($_bShowTitle, $this->_getCaptionTitle($aSection, $iSectionIndex, $aFields, $hfFieldCallback, $aFieldTypeDefinitions), '') . $this->_getCaptionDescription($aSection, $hfSectionCallback) . $this->_getSectionError($aSection, $aFieldErrors) . "</caption>";
    }
    private function _getSectionError($aSection, $aFieldErrors) {
        $_sSectionID = $aSection['section_id'];
        $_sSectionError = isset($aFieldErrors[$_sSectionID]) && is_string($aFieldErrors[$_sSectionID]) ? $aFieldErrors[$_sSectionID] : '';
        return $_sSectionError ? "<div class='admin-page-framework-error'><span class='section-error'>* " . $_sSectionError . "</span></div>" : '';
    }
    private function _getCaptionTitle($aSection, $iSectionIndex, $aFields, $hfFieldCallback, $aFieldTypeDefinitions) {
        $_oSectionTitle = new CustomScrollbar_AdminPageFramework_FormPart_SectionTitle($aSection['title'], 'h3', $aFields, $hfFieldCallback, $iSectionIndex, $aFieldTypeDefinitions);
        return "<div " . $this->generateAttributes(array('class' => 'admin-page-framework-section-title', 'style' => $this->getAOrB($this->_shouldShowCaptionTitle($aSection, $iSectionIndex), '', 'display: none;'),)) . ">" . $_oSectionTitle->get() . "</div>";
    }
    private function _getCaptionDescription($aSection, $hfSectionCallback) {
        if ($aSection['collapsible']) {
            return '';
        }
        if (!is_callable($hfSectionCallback)) {
            return '';
        }
        $_oSectionDescription = new CustomScrollbar_AdminPageFramework_FormPart_Description($aSection['description'], 'admin-page-framework-section-description');
        return "<div class='admin-page-framework-section-description'>" . call_user_func_array($hfSectionCallback, array($_oSectionDescription->get(), $aSection)) . "</div>";
    }
    private function _shouldShowCaptionTitle($aSection, $iSectionIndex) {
        if (!$aSection['title']) {
            return false;
        }
        if ($aSection['collapsible']) {
            return false;
        }
        if ($aSection['section_tab_slug']) {
            return false;
        }
        if ($aSection['repeatable'] && $iSectionIndex != 0) {
            return false;
        }
        return true;
    }
}