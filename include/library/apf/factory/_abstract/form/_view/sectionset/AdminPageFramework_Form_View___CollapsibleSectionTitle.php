<?php
class CustomScrollbar_AdminPageFramework_Form_View___CollapsibleSectionTitle extends CustomScrollbar_AdminPageFramework_Form_View___SectionTitle {
    public $aArguments = array('title' => null, 'tag' => null, 'section_index' => null, 'collapsible' => array(), 'container_type' => 'section', 'sectionset' => array(),);
    public $aFieldsets = array();
    public $aSavedData = array();
    public $aFieldErrors = array();
    public $aFieldTypeDefinitions = array();
    public $oMsg;
    public $aCallbacks = array('fieldset_output', 'is_fieldset_visible' => null,);
    public function get() {
        if (empty($this->aArguments['collapsible'])) {
            return '';
        }
        return $this->_getCollapsibleSectionTitleBlock($this->aArguments['collapsible'], $this->aArguments['container_type'], $this->aArguments['section_index']);
    }
    private function _getCollapsibleSectionTitleBlock(array $aCollapsible, $sContainer = 'sections', $iSectionIndex = null) {
        if ($sContainer !== $aCollapsible['container']) {
            return '';
        }
        $_sSectionTitle = $this->_getSectionTitle($this->aArguments['title'], $this->aArguments['tag'], $this->aFieldsets, $iSectionIndex, $this->aFieldTypeDefinitions, $aCollapsible);
        $_aSectionset = $this->aArguments['sectionset'];
        $_sSectionTitleTagID = str_replace('|', '_', $_aSectionset['_section_path']) . '_' . $iSectionIndex;
        return $this->_getCollapsibleSectionsEnablerScript() . "<div " . $this->getAttributes(array('id' => $_sSectionTitleTagID, 'class' => $this->getClassAttribute('custom-scrollbar-section-title', $this->getAOrB('box' === $aCollapsible['type'], 'accordion-section-title', ''), 'custom-scrollbar-collapsible-title', $this->getAOrB('sections' === $aCollapsible['container'], 'custom-scrollbar-collapsible-sections-title', 'custom-scrollbar-collapsible-section-title'), $this->getAOrB($aCollapsible['is_collapsed'], 'collapsed', ''), 'custom-scrollbar-collapsible-type-' . $aCollapsible['type']),) + $this->getDataAttributeArray($aCollapsible)) . ">" . $_sSectionTitle . "</div>";
    }
    static private $_bLoaded = false;
    protected function _getCollapsibleSectionsEnablerScript() {
        if (self::$_bLoaded) {
            return;
        }
        self::$_bLoaded = true;
        new CustomScrollbar_AdminPageFramework_Form_View___Script_CollapsibleSection($this->oMsg);
    }
}