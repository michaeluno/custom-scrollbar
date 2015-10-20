<?php
class CustomScrollbar_AdminPageFramework_FormPart_Table extends CustomScrollbar_AdminPageFramework_WPUtility {
    public function __construct($aFieldTypeDefinitions, array $aFieldErrors, $oMsg = null) {
        $this->aFieldTypeDefinitions = $aFieldTypeDefinitions;
        $this->aFieldErrors = $aFieldErrors;
        $this->oMsg = $oMsg ? $oMsg : CustomScrollbar_AdminPageFramework_Message::getInstance();
    }
    public function getFormTables($aSections, $aFieldsInSections, $hfSectionCallback, $hfFieldCallback) {
        $_sFieldsType = $this->_getSectionsFieldsType($aSections);
        $this->_divideElementsBySectionTabs($aSections, $aFieldsInSections);
        $_aOutput = array();
        foreach ($aSections as $_sSectionTabSlug => $_aSectionsBySectionTab) {
            $_aOutput[] = $this->_getFormTable($aFieldsInSections, $_sSectionTabSlug, $_aSectionsBySectionTab, $hfSectionCallback, $hfFieldCallback);
        }
        $_oDebugInfo = new CustomScrollbar_AdminPageFramework_FormPart_DebugInfo($_sFieldsType);
        return implode(PHP_EOL, $_aOutput) . CustomScrollbar_AdminPageFramework_Script_Tab::getEnabler() . $_oDebugInfo->get();
    }
    private function _getSectionsFieldsType(array $aSections = array()) {
        foreach ($aSections as $_aSection) {
            return $_aSection['_fields_type'];
        }
    }
    private function _getFormTable(array $aFieldsInSections, $sSectionTabSlug, array $aSectionsBySectionTab, $hfSectionCallback, $hfFieldCallback) {
        if (!count($aFieldsInSections[$sSectionTabSlug])) {
            return '';
        }
        $_sSectionSet = $this->_getSectionsTables($aSectionsBySectionTab, $aFieldsInSections[$sSectionTabSlug], $hfSectionCallback, $hfFieldCallback);
        return $_sSectionSet ? "<div " . $this->getAttributes(array('class' => 'custom-scrollbar-sectionset', 'id' => "sectionset-{$sSectionTabSlug}_" . md5(serialize($aSectionsBySectionTab)),)) . ">" . $_sSectionSet . "</div>" : '';
    }
    private function _divideElementsBySectionTabs(array & $aSections, array & $aFields) {
        $_aSectionsBySectionTab = array();
        $_aFieldsBySectionTab = array();
        $_iIndex = 0;
        foreach ($aSections as $_sSectionID => $_aSection) {
            if (!isset($aFields[$_sSectionID])) {
                continue;
            }
            $_sSectionTaqbSlug = $this->getAOrB($_aSection['section_tab_slug'], $_aSection['section_tab_slug'], '_default_' . (++$_iIndex));
            $_aSectionsBySectionTab[$_sSectionTaqbSlug][$_sSectionID] = $_aSection;
            $_aFieldsBySectionTab[$_sSectionTaqbSlug][$_sSectionID] = $aFields[$_sSectionID];
        }
        $aSections = $_aSectionsBySectionTab;
        $aFields = $_aFieldsBySectionTab;
    }
    private function _getSectionsTables($aSections, $aFieldsInSections, $hfSectionCallback, $hfFieldCallback) {
        if (empty($aSections)) {
            return '';
        }
        $_sSectionTabSlug = '';
        $_aOutputs = array('section_tab_list' => array(), 'section_contents' => array(), 'count_subsections' => 0,);
        $_aFirstSectionset = $this->getFirstEelement($aSections);
        $_sThisSectionID = $_aFirstSectionset['section_id'];
        $_sSectionsID = 'sections-' . $_sThisSectionID;
        $_aCollapsible = $this->_getCollapsibleArgumentForSections($_aFirstSectionset);
        foreach ($aSections as $_aSection) {
            $_sSectionID = $_aSection['section_id'];
            $_sSectionTabSlug = $aSections[$_sSectionID]['section_tab_slug'];
            $_aOutputs = $this->_getSectionsTable($_aOutputs, $_sSectionsID, $_aSection, $aFieldsInSections, $hfSectionCallback, $hfFieldCallback);
        }
        $_aOutputs['section_contents'] = array_filter($_aOutputs['section_contents']);
        return $this->_getFormattedSectionsTablesOutput($_aOutputs, $_aFirstSectionset, $_sSectionsID, $this->getAsArray($_aCollapsible), $_sSectionTabSlug);
    }
    protected function _getCollapsibleArgumentForSections(array $aSection = array()) {
        $_oArgumentFormater = new CustomScrollbar_AdminPageFramework_Format_CollapsibleSection($aSection['collapsible'], $aSection['title'], $aSection);
        $_aCollapsible = $this->getAsArray($_oArgumentFormater->get());
        return isset($_aCollapsible['container']) && 'sections' === $_aCollapsible['container'] ? $_aCollapsible : array();
    }
    private function _getSectionsTable($_aOutputs, $_sSectionsID, array $_aSection, array $aFieldsInSections, $hfSectionCallback, $hfFieldCallback) {
        $_aSubSections = $this->getIntegerKeyElements($this->getElementAsArray($aFieldsInSections, $_aSection['section_id'], array()));
        $_aOutputs['section_contents'][] = $this->_getUnsetFlagSectionInputTag($_aSection);
        $_aOutputs['count_subsections'] = count($_aSubSections);
        if ($_aOutputs['count_subsections']) {
            if (!empty($_aSection['repeatable'])) {
                $_aOutputs['section_contents'][] = CustomScrollbar_AdminPageFramework_Script_RepeatableSection::getEnabler($_sSectionsID, $_aOutputs['count_subsections'], $_aSection['repeatable'], $this->oMsg);
                $_aOutputs['section_contents'][] = $this->_getDynamicElementFlagFieldInputTag($_aSection);
            }
            if (!empty($_aSection['sortable'])) {
                $_aOutputs['section_contents'][] = CustomScrollbar_AdminPageFramework_Script_SortableSection::getEnabler($_sSectionsID, $_aSection['sortable'], $this->oMsg);
                $_aOutputs['section_contents'][] = $this->_getDynamicElementFlagFieldInputTag($_aSection);
            }
            $_aSubSections = $this->numerizeElements($_aSubSections);
            foreach ($_aSubSections as $_iIndex => $_aFields) {
                $_oEachSectionArguments = new CustomScrollbar_AdminPageFramework_Format_EachSection($_aSection, $_iIndex, $_aSubSections, $_sSectionsID);
                $_aOutputs = $this->_getSectionTableWithTabList($_aOutputs, $_oEachSectionArguments->get(), $_aFields, $hfSectionCallback, $hfFieldCallback);
            }
            return $_aOutputs;
        }
        $_oEachSectionArguments = new CustomScrollbar_AdminPageFramework_Format_EachSection($_aSection, null, array(), $_sSectionsID);
        $_aOutputs = $this->_getSectionTableWithTabList($_aOutputs, $_oEachSectionArguments->get(), $this->getElementAsArray($aFieldsInSections, $_aSection['section_id'], array()), $hfSectionCallback, $hfFieldCallback);
        return $_aOutputs;
    }
    private function _getDynamicElementFlagFieldInputTag(array $aSection) {
        return $this->getHTMLTag('input', array('type' => 'hidden', 'name' => '__dynamic_elements_' . $aSection['_fields_type'] . '[' . $aSection['section_id'] . ']', 'class' => 'dynamic-element-names element-address', 'value' => $aSection['section_id'],));
    }
    private function _getUnsetFlagSectionInputTag(array $aSection) {
        if (false !== $aSection['save']) {
            return '';
        }
        return $this->getHTMLTag('input', array('type' => 'hidden', 'name' => '__unset_' . $aSection['_fields_type'] . '[' . $aSection['section_id'] . ']', 'value' => "__dummy_option_key|" . $aSection['section_id'], 'class' => 'unset-element-names element-address',));
    }
    private function _getSectionTableWithTabList(array $_aOutputs, array $_aSection, $_aFields, $hfSectionCallback, $hfFieldCallback) {
        $_aOutputs['section_tab_list'][] = $this->_getTabList($_aSection, $_aFields, $hfFieldCallback);
        $_aOutputs['section_contents'][] = $this->_getSectionTable($_aSection, $_aFields, $hfSectionCallback, $hfFieldCallback);
        return $_aOutputs;
    }
    private function _getFormattedSectionsTablesOutput(array $aOutputs, $aSectionset, $sSectionsID, array $aCollapsible, $sSectionTabSlug) {
        if (empty($aOutputs['section_contents'])) {
            return '';
        }
        $_oCollapsibleSectionTitle = new CustomScrollbar_AdminPageFramework_FormPart_CollapsibleSectionTitle(isset($aCollapsible['title']) ? $aCollapsible['title'] : '', 'h3', array(), null, null, $this->aFieldTypeDefinitions, $aCollapsible, 'sections', $this->oMsg);
        $_oSectionsTablesContainerAttributes = new CustomScrollbar_AdminPageFramework_Attribute_SectionsTablesContainer($aSectionset, $sSectionsID, $sSectionTabSlug, $aCollapsible, $aOutputs['count_subsections']);
        return $_oCollapsibleSectionTitle->get() . "<div " . $_oSectionsTablesContainerAttributes->get() . ">" . $this->_getSectionTabList($sSectionTabSlug, $aOutputs['section_tab_list']) . implode(PHP_EOL, $aOutputs['section_contents']) . "</div>";
    }
    private function _getSectionTabList($sSectionTabSlug, array $aSectionTabList) {
        return $sSectionTabSlug ? "<ul class='custom-scrollbar-section-tabs nav-tab-wrapper'>" . implode(PHP_EOL, $aSectionTabList) . "</ul>" : '';
    }
    private function _getTabList(array $aSection, array $aFields, $hfFieldCallback) {
        if (!$aSection['section_tab_slug']) {
            return '';
        }
        $iSectionIndex = $aSection['_index'];
        $_sSectionTagID = 'section-' . $aSection['section_id'] . '__' . $iSectionIndex;
        $_aTabAttributes = $aSection['attributes']['tab'] + array('class' => 'custom-scrollbar-section-tab nav-tab', 'id' => "section_tab-{$_sSectionTagID}", 'style' => null);
        $_aTabAttributes['class'] = $this->getClassAttribute($_aTabAttributes['class'], $aSection['class']['tab']);
        $_aTabAttributes['style'] = $this->getStyleAttribute($_aTabAttributes['style'], $aSection['hidden'] ? 'display:none' : null);
        $_oSectionTitle = new CustomScrollbar_AdminPageFramework_FormPart_SectionTitle($aSection['title'], 'h4', $aFields, $hfFieldCallback, $iSectionIndex, $this->aFieldTypeDefinitions);
        return "<li " . $this->getAttributes($_aTabAttributes) . ">" . "<a href='#{$_sSectionTagID}'>" . $_oSectionTitle->get() . "</a>" . "</li>";
    }
    private function _getSectionTable($aSection, $aFields, $hfSectionCallback, $hfFieldCallback) {
        if (count($aFields) <= 0) {
            return '';
        }
        $iSectionIndex = $aSection['_index'];
        $_oTableCaption = new CustomScrollbar_AdminPageFramework_FormPart_TableCaption($aSection, $hfSectionCallback, $iSectionIndex, $aFields, $hfFieldCallback, $this->aFieldErrors, $this->aFieldTypeDefinitions, $this->oMsg);
        $_oSectionTableAttributes = new CustomScrollbar_AdminPageFramework_Attribute_SectionTable($aSection);
        $_oSectionTableBodyAttributes = new CustomScrollbar_AdminPageFramework_Attribute_SectionTableBody($aSection);
        $_aOutput = array();
        $_aOutput[] = "<table " . $_oSectionTableAttributes->get() . ">" . $_oTableCaption->get() . "<tbody " . $_oSectionTableBodyAttributes->get() . ">" . $this->getFieldsetRows($aFields, $hfFieldCallback, $iSectionIndex) . "</tbody>" . "</table>";
        $_oSectionTableContainerAttributes = new CustomScrollbar_AdminPageFramework_Attribute_SectionTableContainer($aSection);
        return "<div " . $_oSectionTableContainerAttributes->get() . ">" . implode(PHP_EOL, $_aOutput) . "</div>";
    }
    public function getFieldsetRows(array $aFieldsets, $hfCallback, $iSectionIndex = null) {
        if (!is_callable($hfCallback)) {
            return '';
        }
        $_aOutput = array();
        foreach ($aFieldsets as $_aFieldset) {
            $_oFieldsetOutputFormatter = new CustomScrollbar_AdminPageFramework_Format_FieldsetOutput($_aFieldset, $iSectionIndex, $this->aFieldTypeDefinitions);
            $_oFieldsetRow = new CustomScrollbar_AdminPageFramework_FormPart_TableRow($_oFieldsetOutputFormatter->get(), $hfCallback);
            $_aOutput[] = $_oFieldsetRow->get();
        }
        return implode(PHP_EOL, $_aOutput);
    }
    public function getFieldsets(array $aFieldsets, $hfCallback) {
        if (!is_callable($hfCallback)) {
            return '';
        }
        $_aOutput = array();
        foreach ($aFieldsets as $_aFieldset) {
            $_oFieldsetOutputFormatter = new CustomScrollbar_AdminPageFramework_Format_FieldsetOutput($_aFieldset, null, $this->aFieldTypeDefinitions);
            $_oFieldsetRow = new CustomScrollbar_AdminPageFramework_FormPart_FieldsetRow($_oFieldsetOutputFormatter->get(), $hfCallback);
            $_aOutput[] = $_oFieldsetRow->get();
        }
        return implode(PHP_EOL, $_aOutput);
    }
}