<?php
class CustomScrollbar_AdminPageFramework_FormPart_Description extends CustomScrollbar_AdminPageFramework_FormPart_Base {
    public $aDescriptions = array();
    public $sClassAttribute = 'custom-scrollbar-form-element-description';
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aDescriptions, $this->sClassAttribute,);
        $this->aDescriptions = $this->getAsArray($_aParameters[0]);
        $this->sClassAttribute = $_aParameters[1];
    }
    public function get() {
        if (empty($this->aDescriptions)) {
            return '';
        }
        $_aOutput = array();
        foreach ($this->aDescriptions as $_sDescription) {
            $_aOutput[] = "<p class='" . esc_attr($this->sClassAttribute) . "'>" . "<span class='description'>" . $_sDescription . "</span>" . "</p>";
        }
        return implode(PHP_EOL, $_aOutput);
    }
}