<?php
abstract class CustomScrollbar_AdminPageFramework_Factory_View extends CustomScrollbar_AdminPageFramework_Factory_Model {
    public function __construct($oProp) {
        parent::__construct($oProp);
        if (!$this->_isInThePage()) {
            return;
        }
        if ($this->oProp->bIsAdminAjax) {
            return;
        }
        new CustomScrollbar_AdminPageFramework_Factory_View__SettingNotice($this);
    }
    public function _replyToGetSectionName() {
        $_aParams = func_get_args() + array(null, null,);
        return $_aParams[0];
    }
    public function _replyToGetInputID() {
        $_aParams = func_get_args() + array(null, null, null, null);
        return $_aParams[0];
    }
    public function _replyToGetInputTagIDAttribute() {
        $_aParams = func_get_args() + array(null, null, null, null);
        return $_aParams[0];
    }
    public function _replyToGetFieldNameAttribute() {
        $_aParams = func_get_args() + array(null, null,);
        return $_aParams[0];
    }
    public function _replyToGetFlatFieldName() {
        $_aParams = func_get_args() + array(null, null,);
        return $_aParams[0];
    }
    public function _replyToGetInputNameAttribute() {
        $_aParams = func_get_args() + array(null, null, null);
        return $_aParams[0];
    }
    public function _replyToGetFlatInputName() {
        $_aParams = func_get_args() + array(null, null, null);
        return $_aParams[0];
    }
    public function _replyToGetInputClassAttribute() {
        $_aParams = func_get_args() + array(null, null, null, null);
        return $_aParams[0];
    }
    public function _replyToDetermineSectionsetVisibility($bVisible, $aSectionset) {
        return $this->_isElementVisible($aSectionset, $bVisible);
    }
    public function _replyToDetermineFieldsetVisibility($bVisible, $aFieldset) {
        return $this->_isElementVisible($aFieldset, $bVisible);
    }
    private function _isElementVisible($aElementDefinition, $bDefault) {
        $aElementDefinition = $aElementDefinition + array('if' => true, 'capability' => '',);
        if (!$aElementDefinition['if']) {
            return false;
        }
        if (!$aElementDefinition['capability']) {
            return true;
        }
        if (!current_user_can($aElementDefinition['capability'])) {
            return false;
        }
        return $bDefault;
    }
    public function isSectionSet(array $aFieldset) {
        $aFieldset = $aFieldset + array('section_id' => null,);
        return $aFieldset['section_id'] && '_default' !== $aFieldset['section_id'];
    }
    public function _replyToGetSectionHeaderOutput($sSectionDescription, $aSectionset) {
        return $this->oUtil->addAndApplyFilters($this, array('section_head_' . $this->oProp->sClassName . '_' . $aSectionset['section_id']), $sSectionDescription);
    }
    public function _replyToGetFieldOutput($sFieldOutput, $aFieldset) {
        $_sSectionPart = $this->oUtil->getAOrB(isset($aFieldset['section_id']) && '_default' !== $aFieldset['section_id'], '_' . $aFieldset['section_id'], '');
        return $this->oUtil->addAndApplyFilters($this, array('field_' . $this->oProp->sClassName . $_sSectionPart . '_' . $aFieldset['field_id']), $sFieldOutput, $aFieldset);
    }
}