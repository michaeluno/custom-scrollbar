<?php
class CustomScrollbar_AdminPageFramework_Form_View___CSS_CollapsibleSectionIE extends CustomScrollbar_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->_getCollapsibleSectionsRules();
    }
    private function _getCollapsibleSectionsRules() {
        return <<<CSSRULES
/* Collapsible sections - in IE tbody and tr cannot set paddings */        
tbody.custom-scrollbar-collapsible-content > tr > th,
tbody.custom-scrollbar-collapsible-content > tr > td
{
    padding-right: 20px;
    padding-left: 20px;
}

CSSRULES;
        
    }
}