<?php
class CustomScrollbar_AdminPageFramework_FormPart_FieldsetRow extends CustomScrollbar_AdminPageFramework_FormPart_TableRow {
    protected function _getRow(array $aFieldset, $hfCallback) {
        if ('section_title' === $aFieldset['type']) {
            return '';
        }
        $_oFieldrowAttribute = new CustomScrollbar_AdminPageFramework_Attribute_Fieldrow($aFieldset);
        return $this->_getFieldByContainer($aFieldset, $hfCallback, array('open_main' => "<div " . $_oFieldrowAttribute->get() . ">", 'close_main' => "</div>",));
    }
}