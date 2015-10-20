<?php
class CustomScrollbar_AdminPageFramework_FieldType_text extends CustomScrollbar_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('text', 'password', 'date', 'datetime', 'datetime-local', 'email', 'month', 'search', 'tel', 'url', 'week',);
    protected $aDefaultKeys = array('attributes' => array('maxlength' => 400,),);
    protected function getStyles() {
        return <<<CSSRULES
/* Text Field Type */
.custom-scrollbar-field.custom-scrollbar-field-text > .custom-scrollbar-input-label-container {
    vertical-align: top; 
}

.custom-scrollbar-field.custom-scrollbar-field-text > .custom-scrollbar-input-label-container.custom-scrollbar-field-text-multiple-labels {
    /* When the browser screen width gets narrow, avoid the inputs getting placed next each other. */
    display: block;
}
CSSRULES;
        
    }
    protected function getField($aField) {
        $_aOutput = array();
        foreach (( array )$aField['label'] as $_sKey => $_sLabel) {
            $_aOutput[] = $this->_getFieldOutputByLabel($_sKey, $_sLabel, $aField);
        }
        $_aOutput[] = "<div class='repeatable-field-buttons'></div>";
        return implode('', $_aOutput);
    }
    private function _getFieldOutputByLabel($sKey, $sLabel, $aField) {
        $_bIsArray = is_array($aField['label']);
        $_sClassSelector = $_bIsArray ? 'custom-scrollbar-field-text-multiple-labels' : '';
        $_sLabel = $this->getElementByLabel($aField['label'], $sKey, $_bIsArray);
        $aField['value'] = $this->getElementByLabel($aField['value'], $sKey, $_bIsArray);
        $_aInputAttributes = $_bIsArray ? array('name' => $aField['attributes']['name'] . "[{$sKey}]", 'id' => $aField['attributes']['id'] . "_{$sKey}", 'value' => $aField['value'],) + $aField['attributes'] : $aField['attributes'];
        $_aOutput = array($this->getElementByLabel($aField['before_label'], $sKey, $_bIsArray), "<div class='custom-scrollbar-input-label-container {$_sClassSelector}'>", "<label for='" . $_aInputAttributes['id'] . "'>", $this->getElementByLabel($aField['before_input'], $sKey, $_bIsArray), $_sLabel ? "<span class='custom-scrollbar-input-label-string' style='min-width:" . $this->sanitizeLength($aField['label_min_width']) . ";'>" . $_sLabel . "</span>" : '', "<input " . $this->getAttributes($_aInputAttributes) . " />", $this->getElementByLabel($aField['after_input'], $sKey, $_bIsArray), "</label>", "</div>", $this->getElementByLabel($aField['after_label'], $sKey, $_bIsArray),);
        return implode('', $_aOutput);
    }
}