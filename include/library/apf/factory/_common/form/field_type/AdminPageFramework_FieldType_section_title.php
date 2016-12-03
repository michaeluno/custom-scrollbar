<?php 
/**
	Admin Page Framework v3.8.12 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_FieldType_section_title extends CustomScrollbar_AdminPageFramework_FieldType_text {
    public $aFieldTypeSlugs = array('section_title',);
    protected $aDefaultKeys = array('label_min_width' => 30, 'attributes' => array('size' => 20, 'maxlength' => 100,),);
    protected function getStyles() {
        return ".custom-scrollbar-section-tab .custom-scrollbar-field-section_title {padding: 0.5em;} .custom-scrollbar-section-tab .custom-scrollbar-field-section_title .custom-scrollbar-input-label-string { vertical-align: middle; margin-left: 0.2em;}.custom-scrollbar-section-tab .custom-scrollbar-fields {display: inline-block;} .custom-scrollbar-field.custom-scrollbar-field-section_title {float: none;} .custom-scrollbar-field.custom-scrollbar-field-section_title input {background-color: #fff;color: #333;border-color: #ddd;box-shadow: inset 0 1px 2px rgba(0,0,0,.07);border-width: 1px;border-style: solid;outline: 0;box-sizing: border-box;vertical-align: middle;}";
    }
    protected function getField($aField) {
        $aField['attributes'] = array('type' => 'text') + $aField['attributes'];
        return parent::getField($aField);
    }
}
