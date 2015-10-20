<?php
abstract class CustomScrollbar_AdminPageFramework_Generate_Field_Base extends CustomScrollbar_AdminPageFramework_Generate_Section_Base {
    protected function _isSectionSet() {
        return isset($this->aArguments['section_id']) && $this->aArguments['section_id'] && '_default' !== $this->aArguments['section_id'];
    }
}