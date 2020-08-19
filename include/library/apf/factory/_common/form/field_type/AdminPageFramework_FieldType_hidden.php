<?php 
/**
	Admin Page Framework v3.8.21b01 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_FieldType_hidden extends CustomScrollbar_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('hidden');
    protected $aDefaultKeys = array();
    protected function getField($aField) {
        return $aField['before_label'] . "<div class='custom-scrollbar-input-label-container'>" . "<label for='{$aField['input_id']}'>" . $aField['before_input'] . ($aField['label'] ? "<span " . $this->getLabelContainerAttributes($aField, 'custom-scrollbar-input-label-string') . ">" . $aField['label'] . "</span>" : "") . "<input " . $this->getAttributes($aField['attributes']) . " />" . $aField['after_input'] . "</label>" . "</div>" . $aField['after_label'];
    }
    }
    