<?php
class CustomScrollbar_AdminPageFramework_Generate_FlatFieldInputName extends CustomScrollbar_AdminPageFramework_Generate_FieldInputName {
    public function get() {
        $_sIndex = $this->getAOrB('0' !== $this->sIndex && empty($this->sIndex), '', "|{$this->sIndex}");
        return $this->_getFiltered($this->_getFlatFieldName() . $_sIndex);
    }
}