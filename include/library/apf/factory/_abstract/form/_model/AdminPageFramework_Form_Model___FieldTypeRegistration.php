<?php
class CustomScrollbar_AdminPageFramework_Form_Model___FieldTypeRegistration extends CustomScrollbar_AdminPageFramework_WPUtility {
    public function __construct(array $aFieldTypeDefinition, $sStructureType) {
        $this->_initialize($aFieldTypeDefinition, $sStructureType);
    }
    private function _initialize($aFieldTypeDefinition, $sStructureType) {
        if (is_callable($aFieldTypeDefinition['hfFieldSetTypeSetter'])) {
            call_user_func_array($aFieldTypeDefinition['hfFieldSetTypeSetter'], array($sStructureType));
        }
        if (is_callable($aFieldTypeDefinition['hfFieldLoader'])) {
            call_user_func_array($aFieldTypeDefinition['hfFieldLoader'], array());
        }
    }
}