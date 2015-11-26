<?php
class CustomScrollbar_AdminPageFramework_Form_View___Attribute_SectionTable extends CustomScrollbar_AdminPageFramework_Form_View___Attribute_Base {
    public $sContext = 'section_table';
    protected function _getAttributes() {
        return array('id' => 'section_table-' . $this->aArguments['_tag_id'], 'class' => $this->getClassAttribute('form-table', 'custom-scrollbar-section-table'),);
    }
}