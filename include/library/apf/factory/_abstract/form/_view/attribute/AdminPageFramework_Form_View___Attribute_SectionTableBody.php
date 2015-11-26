<?php
class CustomScrollbar_AdminPageFramework_Form_View___Attribute_SectionTableBody extends CustomScrollbar_AdminPageFramework_Form_View___Attribute_Base {
    public $sContext = 'section_table_content';
    protected function _getAttributes() {
        $_sCollapsibleType = $this->getElement($this->aArguments, array('collapsible', 'type'), 'box');
        return array('class' => $this->getAOrB($this->aArguments['_is_collapsible'], 'custom-scrollbar-collapsible-section-content' . ' ' . 'custom-scrollbar-collapsible-content' . ' ' . 'accordion-section-content' . ' ' . 'custom-scrollbar-collapsible-content-type-' . $_sCollapsibleType, null),);
    }
}