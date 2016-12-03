<?php 
/**
	Admin Page Framework v3.8.12 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_Form_Meta extends CustomScrollbar_AdminPageFramework_Form {
    public function updateMetaDataByType($iObjectID, array $aInput, array $aSavedMeta, $sStructureType = 'post_meta_box') {
        if (!$iObjectID) {
            return;
        }
        $_aFunctionNameMapByFieldsType = array('post_meta_box' => 'update_post_meta', 'user_meta' => 'update_user_meta', 'term_meta' => 'update_term_meta',);
        if (!in_array($sStructureType, array_keys($_aFunctionNameMapByFieldsType))) {
            return;
        }
        $_sFunctionName = $this->getElement($_aFunctionNameMapByFieldsType, $sStructureType);
        $aInput = $this->_getInputByUnset($aInput);
        foreach ($aInput as $_sSectionOrFieldID => $_vValue) {
            $this->_updateMetaDatumByFuncitonName($iObjectID, $_vValue, $aSavedMeta, $_sSectionOrFieldID, $_sFunctionName);
        }
    }
    private function _getInputByUnset(array $aInput) {
        $_sUnsetKey = '__unset_' . $this->sStructureType;
        if (!isset($_POST[$_sUnsetKey])) {
            return $aInput;
        }
        $_aUnsetElements = array_unique($_POST[$_sUnsetKey]);
        foreach ($_aUnsetElements as $_sFlatInputName) {
            $_aDimensionalKeys = explode('|', $_sFlatInputName);
            if (!isset($_aDimensionalKeys[0])) {
                continue;
            }
            if ('__dummy_option_key' === $_aDimensionalKeys[0]) {
                array_shift($_aDimensionalKeys);
            }
            $this->unsetDimensionalArrayElement($aInput, $_aDimensionalKeys);
        }
        return $aInput;
    }
    private function _updateMetaDatumByFuncitonName($iObjectID, $_vValue, array $aSavedMeta, $_sSectionOrFieldID, $_sFunctionName) {
        if (is_null($_vValue)) {
            return;
        }
        $_vSavedValue = $this->getElement($aSavedMeta, $_sSectionOrFieldID, null);
        if ($_vValue == $_vSavedValue) {
            return;
        }
        $_sFunctionName($iObjectID, $_sSectionOrFieldID, $_vValue);
    }
}
