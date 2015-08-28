<?php
abstract class CustomScrollbar_AdminPageFramework_Form_View extends CustomScrollbar_AdminPageFramework_Form_Model {
    public function _replyToGetSectionName() {
        $_aParams = func_get_args() + array(null, null,);
        $sNameAttribute = $_aParams[0];
        $aSectionset = $_aParams[1];
        $_aDimensionalKeys = array($this->oProp->sOptionKey);
        $_aDimensionalKeys[] = '[' . $aSectionset['section_id'] . ']';
        if (isset($aSectionset['_index'])) {
            $_aDimensionalKeys[] = '[' . $aSectionset['_index'] . ']';
        }
        return implode('', $_aDimensionalKeys);
    }
    public function _replyToGetFieldNameAttribute() {
        $_aParams = func_get_args() + array(null, null,);
        $sNameAttribute = $_aParams[0];
        $aFieldset = $_aParams[1];
        $_aDimensionalKeys = array($aFieldset['option_key']);
        if ($this->isSectionSet($aFieldset)) {
            $_aDimensionalKeys[] = '[' . $aFieldset['section_id'] . ']';
        }
        if (isset($aFieldset['section_id'], $aFieldset['_section_index'])) {
            $_aDimensionalKeys[] = '[' . $aFieldset['_section_index'] . ']';
        }
        $_aDimensionalKeys[] = '[' . $aFieldset['field_id'] . ']';
        return implode('', $_aDimensionalKeys);
    }
    public function _replyToGetFlatFieldName() {
        $_aParams = func_get_args() + array(null, null,);
        $sNameAttribute = $_aParams[0];
        $aFieldset = $_aParams[1];
        $_aDimensionalKeys = array($aFieldset['option_key']);
        if ($this->isSectionSet($aFieldset)) {
            $_aDimensionalKeys[] = $aFieldset['section_id'];
        }
        if (isset($aFieldset['section_id'], $aFieldset['_section_index'])) {
            $_aDimensionalKeys[] = $aFieldset['_section_index'];
        }
        $_aDimensionalKeys[] = $aFieldset['field_id'];
        return implode('|', $_aDimensionalKeys);
    }
    public function _replyToGetInputNameAttribute() {
        $_aParams = func_get_args() + array(null, null, null);
        $sNameAttribute = $_aParams[0];
        $aField = $_aParams[1];
        $sKey = ( string )$_aParams[2];
        $sKey = $this->oUtil->getAOrB('0' !== $sKey && empty($sKey), '', "[{$sKey}]");
        return $this->_replyToGetFieldNameAttribute('', $aField) . $sKey;
    }
    public function _replyToGetFlatInputName() {
        $_aParams = func_get_args() + array(null, null, null);
        $sFlatNameAttribute = $_aParams[0];
        $aField = $_aParams[1];
        $_sKey = ( string )$_aParams[2];
        $_sKey = $this->oUtil->getAOrB('0' !== $_sKey && empty($_sKey), '', "|" . $_sKey);
        return $this->_replyToGetFlatFieldName('', $aField) . $_sKey;
    }
    public function _replyToGetSectionHeaderOutput($sSectionDescription, $aSection) {
        return $this->oUtil->addAndApplyFilters($this, array('section_head_' . $this->oProp->sClassName . '_' . $aSection['section_id']), $sSectionDescription);
    }
    public function _replyToGetFieldOutput($aField) {
        $_sCurrentPageSlug = $this->oProp->getCurrentPageSlug();
        $_sSectionID = $this->oUtil->getElement($aField, 'section_id', '_default');
        $_sFieldID = $aField['field_id'];
        if ($aField['page_slug'] != $_sCurrentPageSlug) {
            return '';
        }
        $this->aFieldErrors = isset($this->aFieldErrors) ? $this->aFieldErrors : $this->_getFieldErrors($_sCurrentPageSlug);
        $sFieldType = isset($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfRenderField']) && is_callable($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfRenderField']) ? $aField['type'] : 'default';
        $_aTemp = $this->getSavedOptions();
        $_oFieldset = new CustomScrollbar_AdminPageFramework_FormFieldset($aField, $_aTemp, $this->aFieldErrors, $this->oProp->aFieldTypeDefinitions, $this->oMsg, $this->oProp->aFieldCallbacks);
        $_sFieldOutput = $_oFieldset->get();
        unset($_oFieldset);
        return $this->oUtil->addAndApplyFilters($this, array(isset($aField['section_id']) && '_default' !== $aField['section_id'] ? 'field_' . $this->oProp->sClassName . '_' . $aField['section_id'] . '_' . $_sFieldID : 'field_' . $this->oProp->sClassName . '_' . $_sFieldID,), $_sFieldOutput, $aField);
    }
}