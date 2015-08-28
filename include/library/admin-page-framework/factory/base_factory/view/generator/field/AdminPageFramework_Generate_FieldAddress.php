<?php
class CustomScrollbar_AdminPageFramework_Generate_FieldAddress extends CustomScrollbar_AdminPageFramework_Generate_FlatFieldName {
    public function get() {
        return $this->_getFlatFieldName();
    }
    public function getModel() {
        return $this->get() . '|' . $this->sIndexMark;
    }
}