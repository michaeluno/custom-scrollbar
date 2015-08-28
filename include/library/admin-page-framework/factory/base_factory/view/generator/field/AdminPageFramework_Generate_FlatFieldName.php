<?php
class CustomScrollbar_AdminPageFramework_Generate_FlatFieldName extends CustomScrollbar_AdminPageFramework_Generate_FieldName {
    public function get() {
        return $this->_getFiltered($this->_getFlatFieldName());
    }
    public function getModel() {
        return $this->get() . '|' . $this->sIndexMark;
    }
    protected function _getFlatFieldName() {
        $_sSectionIndex = isset($this->aArguments['section_id'], $this->aArguments['_section_index']) ? "|{$this->aArguments['_section_index']}" : '';
        return $this->getAOrB($this->_isSectionSet(), "{$this->aArguments['section_id']}{$_sSectionIndex}|{$this->aArguments['field_id']}", "{$this->aArguments['field_id']}");
    }
}