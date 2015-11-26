<?php
class CustomScrollbar_AdminPageFramework_Form_View___CSS_Section extends CustomScrollbar_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->_getFormSectionRules();
    }
    private function _getFormSectionRules() {
        return <<<CSSRULES
/* Section Table */
.custom-scrollbar-section .form-table {
    margin-top: 0;
}
.custom-scrollbar-section .form-table td label {
   display: inline;  /* adjusts the horizontal alignment with the th element */
}
/* Section Tabs */
.custom-scrollbar-section-tabs-contents {
    margin-top: 1em;
}
.custom-scrollbar-section-tabs { /* The section tabs' container */
    margin: 0;
}
.custom-scrollbar-tab-content { /* each section including sub-sections of repeatable fields */
    padding: 0.5em 2em 1.5em 2em;
    margin: 0;
    border-style: solid;
    border-width: 1px;
    border-color: #dfdfdf;
    background-color: #fdfdfd;     
}
.custom-scrollbar-section-tab {
    background-color: transparent;
    vertical-align: bottom; /* for Firefox */
}
.custom-scrollbar-section-tab.active {
    background-color: #fdfdfd;     
}
.custom-scrollbar-section-tab h4 {
    margin: 0;
    padding: 8px 14px 10px;
    font-size: 1.2em;
    vertical-align: middle;
    white-space: nowrap;
    display:inline-block;
}
.custom-scrollbar-section-tab.nav-tab {
    padding: 0;
}
.custom-scrollbar-section-tab.nav-tab a {
    text-decoration: none;
    color: #464646;
    vertical-align: inherit; /* for Firefox - without this tiny dots appear */
    outline: 0; /* for FireFox - remove dotted outline */
}        
.custom-scrollbar-section-tab.nav-tab a:focus { 
    /* For FireFox - remove dotted outline when a switchable tab is activated */
    box-shadow: none;
}
.custom-scrollbar-section-tab.nav-tab.active a {
    color: #000;
}
.custom-scrollbar-content ul.custom-scrollbar-section-tabs > li.custom-scrollbar-section-tab {    
    /* Do not show bullets in section tabs */
    list-style-type: none;
    /* For WordPress 4.4, make sure to attach the tab to the container */
    margin: -4px 4px -1px 0;
}
/* Repeatable Sections */
.custom-scrollbar-repeatable-section-buttons {
    float: right;
    clear: right;
    margin-top: 1em;
}
/* Section Caption */
.custom-scrollbar-section-caption {
    text-align: left;
    margin: 0;
}
/* Section Title */
.custom-scrollbar-section .custom-scrollbar-section-title {
    /* background: none; */               /* @todo examine what this is for. @deprecated 3.4.0 for repeatable collapsible section titles */
    /* -webkit-box-shadow: none; */       /* @todo examine what this is for. @deprecated 3.4.0 for repeatable collapsible section titles */
    /* _box-shadow: none; */              /* @todo examine what this is for. @deprecated 3.4.0 for repeatable collapsible section titles */
}

/* Sortable Sections */
.custom-scrollbar-sections.sortable-section > .custom-scrollbar-section {
    padding: 1em 2em 1em 2em;
}

/* Sortable Collapsible Sections */
.custom-scrollbar-sections.sortable-section > .custom-scrollbar-section.is_subsection_collapsible {
    display: block; 
    float: none;
    border: 0px;
    padding: 0;
    background: transparent;
}
/* Sortable Tabbed Sections */
.custom-scrollbar-sections.sortable-section > .custom-scrollbar-tab-content {
    display: block; 
    float: none;
    border: 0px;    

    padding: 0.5em 2em 1.5em 2em;
    margin: 0;
    border-style: solid;
    border-width: 1px;
    border-color: #dfdfdf;
    background-color: #fdfdfd;      
}

.custom-scrollbar-sections.sortable-section > .custom-scrollbar-section {
    margin-bottom: 1em;
}
.custom-scrollbar-section {
    margin-bottom: 1em; /* gives a margin between sections. This helps for the debug info in each sectionset and collapsible sections. */
}            
.custom-scrollbar-sectionset {
    margin-bottom: 1em; 
    display:inline-block;
    width:100%;
}            
/* Nested sections */
.custom-scrollbar-section > .custom-scrollbar-sectionset {
    margin-left: 2em;
}

CSSRULES;
        
    }
}