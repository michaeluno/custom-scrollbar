<?php
class CustomScrollbar_AdminPageFramework_Attribute_Fieldset extends CustomScrollbar_AdminPageFramework_Attribute_FieldContainer_Base {
    public $sContext = 'fieldset';
    protected function _getAttributes() {
        return array('id' => $this->sContext . '-' . $this->aArguments['tag_id'], 'class' => 'custom-scrollbar-' . $this->sContext, 'data-field_id' => $this->aArguments['tag_id'],);
    }
}