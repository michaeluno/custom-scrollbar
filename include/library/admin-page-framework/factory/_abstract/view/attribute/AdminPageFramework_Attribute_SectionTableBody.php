<?php
class CustomScrollbar_AdminPageFramework_Attribute_SectionTableBody extends CustomScrollbar_AdminPageFramework_Attribute_Base {
    public $sContext = 'section_table_content';
    protected function _getAttributes() {
        return array('class' => $this->getAOrB($this->aArguments['_is_collapsible'], 'custom-scrollbar-collapsible-section-content' . ' ' . 'custom-scrollbar-collapsible-content' . ' ' . 'accordion-section-content', null),);
    }
}