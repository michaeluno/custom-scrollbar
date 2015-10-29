<?php
abstract class CustomScrollbar_AdminPageFramework_Factory_Model extends CustomScrollbar_AdminPageFramework_Factory_Router {
    protected function _setUp() {
        $this->setUp();
    }
    static private $_aFieldTypeDefinitions = array();
    protected function _loadFieldTypeDefinitions() {
        if (empty(self::$_aFieldTypeDefinitions)) {
            self::$_aFieldTypeDefinitions = CustomScrollbar_AdminPageFramework_FieldTypeRegistration::register(array(), $this->oProp->sClassName, $this->oMsg);
        }
        $this->oProp->aFieldTypeDefinitions = $this->oUtil->addAndApplyFilters($this, array('field_types_admin_page_framework', "field_types_{$this->oProp->sClassName}",), self::$_aFieldTypeDefinitions);
    }
    protected function _registerFields(array $aFields) {
        foreach ($aFields as $_sSecitonID => $_aFields) {
            $_bIsSubSectionLoaded = false;
            foreach ($_aFields as $_iSubSectionIndexOrFieldID => $_aSubSectionOrField) {
                if ($this->oUtil->isNumericInteger($_iSubSectionIndexOrFieldID)) {
                    if ($_bIsSubSectionLoaded) {
                        continue;
                    }
                    $_bIsSubSectionLoaded = true;
                    foreach ($_aSubSectionOrField as $_aField) {
                        $this->_registerField($_aField);
                    }
                    continue;
                }
                $_aField = $_aSubSectionOrField;
                $this->_registerField($_aField);
            }
        }
    }
    protected function _registerField(array $aField) {
        CustomScrollbar_AdminPageFramework_FieldTypeRegistration::_setFieldResources($aField, $this->oProp, $this->oResource);
        if ($aField['help']) {
            $this->oHelpPane->_addHelpTextForFormFields($aField['title'], $aField['help'], $aField['help_aside']);
        }
        if (isset($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfDoOnRegistration']) && is_callable($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfDoOnRegistration'])) {
            call_user_func_array($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfDoOnRegistration'], array($aField));
        }
    }
    public function getSavedOptions() {
        return $this->oProp->aOptions;
    }
    public function getFieldErrors() {
        return $this->_getFieldErrors();
    }
    protected function _getFieldErrors($sID = 'deprecated', $bDelete = true) {
        static $_aFieldErrors;
        $_sTransientKey = "apf_field_erros_" . get_current_user_id();
        $_sID = md5($this->oProp->sClassName);
        $_aFieldErrors = isset($_aFieldErrors) ? $_aFieldErrors : $this->oUtil->getTransient($_sTransientKey);
        if ($bDelete) {
            add_action('shutdown', array($this, '_replyToDeleteFieldErrors'));
        }
        return $this->oUtil->getElementAsArray($_aFieldErrors, $_sID, array());
    }
    protected function _isValidationErrors() {
        if (isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors']) && $GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors']) {
            return true;
        }
        return $this->oUtil->getTransient("apf_field_erros_" . get_current_user_id());
    }
    public function _replyToDeleteFieldErrors() {
        $this->oUtil->deleteTransient("apf_field_erros_" . get_current_user_id());
    }
    public function _replyToSaveFieldErrors() {
        if (!isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'])) {
            return;
        }
        $this->oUtil->setTransient("apf_field_erros_" . get_current_user_id(), $GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'], 300);
    }
    public function _replyToSaveNotices() {
        if (!isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices'])) {
            return;
        }
        if (empty($GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices'])) {
            return;
        }
        $this->oUtil->setTransient('apf_notices_' . get_current_user_id(), $GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices']);
    }
    public function _setLastInput(array $aLastInput) {
        return $this->oUtil->setTransient('apf_tfd' . md5('temporary_form_data_' . $this->oProp->sClassName . get_current_user_id()), $aLastInput, 60 * 60);
    }
    protected function _getSortedInputs(array $aInput) {
        $_sFieldAddressKey = '__dynamic_elements_' . $this->oProp->sFieldsType;
        if (!isset($_POST[$_sFieldAddressKey])) {
            return $aInput;
        }
        $_oInputSorter = new CustomScrollbar_AdminPageFramework_Sort_Input($aInput, $_POST[$_sFieldAddressKey]);
        return $_oInputSorter->get();
    }
}