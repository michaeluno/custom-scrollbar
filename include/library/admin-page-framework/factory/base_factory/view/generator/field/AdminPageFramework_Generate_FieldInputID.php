<?php
class CustomScrollbar_AdminPageFramework_Generate_FieldInputID extends CustomScrollbar_AdminPageFramework_Generate_FieldTagID {
    public $isIndex = '';
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aArguments, $this->isIndex, $this->hfCallback,);
        $this->aArguments = $_aParameters[0];
        $this->isIndex = $_aParameters[1];
        $this->hfCallback = $_aParameters[2];
    }
    public function get() {
        return $this->_getFiltered($this->_getBaseFieldTagID() . '__' . $this->isIndex);
    }
}