<?php
class CustomScrollbar_AdminPageFramework_Form_View___Attribute_Field extends CustomScrollbar_AdminPageFramework_Form_View___Attribute_FieldContainer_Base {
    public $sContext = 'field';
    protected function _getAttributes() {
        return array('id' => $this->aArguments['_field_container_id'], 'data-type' => $this->aArguments['type'], 'class' => "custom-scrollbar-field custom-scrollbar-field-" . $this->aArguments['type'] . $this->getAOrB($this->aArguments['attributes']['disabled'], ' disabled', '') . $this->getAOrB($this->aArguments['_is_sub_field'], ' custom-scrollbar-subfield', ''));
    }
}