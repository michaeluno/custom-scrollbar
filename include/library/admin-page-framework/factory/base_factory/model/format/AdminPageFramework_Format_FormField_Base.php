<?php
abstract class CustomScrollbar_AdminPageFramework_Format_FormField_Base extends CustomScrollbar_AdminPageFramework_Format_Base {
    protected function _isSectionSet(array $aField) {
        return isset($aField['section_id']) && $aField['section_id'] && '_default' !== $aField['section_id'];
    }
}