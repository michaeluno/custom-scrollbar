<?php
class CustomScrollbar_AdminPageFramework_CSS {
    static public function getDefaultCSS() {
        $_sCSS = <<<CSSRULES
/* Settings Notice */
.wrap div.updated.custom-scrollbar-settings-notice-container, 
.wrap div.error.custom-scrollbar-settings-notice-container, 
.media-upload-form div.error.custom-scrollbar-settings-notice-container
{
    clear: both;
    margin-top: 16px;
}
.wrap div.error.confirmation.custom-scrollbar-settings-notice-container {
    border-color: #368ADD;
}        
/* Contextual Help Page */
.contextual-help-description {
    clear: left;    
    display: block;
    margin: 1em 0;
}
.contextual-help-tab-title {
    font-weight: bold;
}

/* Page Meta Boxes */
.custom-scrollbar-content {

    margin-bottom: 1.48em;     
    width: 100%; /* This allows float:right elements to go to the very right end of the page. */
    
    /* display: inline-table; */ /* @deprecated 3.5.0. Fixes the bottom margin getting placed at the top. */
    /* [3.5.0+] The above display: inline-table makes it hard to display code blocks with overflow as container cannot have solid width. */
    display: block; 

}

/* Regular Heading Titles - the meta box container element affects the styles of regular main content output. So it needs to be fixed. */
.custom-scrollbar-container #poststuff .custom-scrollbar-content h3 {
    font-weight: bold;
    font-size: 1.3em;
    margin: 1em 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;
} 

/* Tab Navigation Bar */
.nav-tab.tab-disabled,
.nav-tab.tab-disabled:hover {
    font-weight: normal;
    color: #AAAAAA;
}

/* In-page tabs */ 
.custom-scrollbar-in-page-tab .nav-tab.nav-tab-active {
    border-bottom-width: 2px;
}
/* Give a space between generic admin notice containers and the in-page navigation tabs */
.wrap .custom-scrollbar-in-page-tab div.error, 
.wrap .custom-scrollbar-in-page-tab div.updated {
    margin-top: 15px;
}

/* Framework System Information */
.custom-scrollbar-info {
    font-size: 0.8em;
    font-weight: lighter;
    text-align: right;
}

/* Debug containers */
pre.dump-array {
    border: 1px solid #ededed;
    margin: 24px 2em;
    margin: 1.714285714rem 2em;
    padding: 24px;
    padding: 1.714285714rem;				
    overflow-x: auto; 
    white-space: pre-wrap;
    background-color: #FFF;
    margin-bottom: 2em;
    width: auto;
}
CSSRULES;
        return $_sCSS . PHP_EOL . self::_getFormSectionRules() . PHP_EOL . self::_getFormFieldRules() . PHP_EOL . self::_getCollapsibleSectionsRules() . PHP_EOL . self::_getFieldErrorRules() . PHP_EOL . self::_getMetaBoxFormRules() . PHP_EOL . self::_getWidgetFormRules() . PHP_EOL . self::_getPageLoadStatsRules() . PHP_EOL . self::_getVersionSpecificRules($GLOBALS['wp_version']);
    }
    static private function _getFormSectionRules() {
        return <<<CSSRULES
.custom-scrollbar-section {
    margin-bottom: 1em; /* gives a margin between sections. This helps for the debug info in each sectionset and collapsible sections. */
}            
.custom-scrollbar-sectionset {
    margin-bottom: 1em; 
    display:inline-block;
    width:100%;
}            
CSSRULES;
        
    }
    static private function _getFormFieldRules() {
        return <<<CSSRULES
/* Form Elements */
/* TD paddings when the field title is disabled */
td.custom-scrollbar-field-td-no-title {
    padding-left: 0;
    padding-right: 0;
}
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

/* Fields Container */
.custom-scrollbar-fields {
    display: table; /* the block property does not give the element the solid height */
    width: 100%;
    table-layout: fixed;    /* in Firefox, fix the issue that preview images cause the container element to expand */
}

/* Number Input */
.custom-scrollbar-field input[type='number'] {
    text-align: right;
}     

/* Disabled */
.custom-scrollbar-fields .disabled,
.custom-scrollbar-fields .disabled input,
.custom-scrollbar-fields .disabled textarea,
.custom-scrollbar-fields .disabled select,
.custom-scrollbar-fields .disabled option {
    color: #BBB;
}

/* HR */
.custom-scrollbar-fields hr {
    border: 0; 
    height: 0;
    border-top: 1px solid #dfdfdf; 
}

/* Delimiter */
.custom-scrollbar-fields .delimiter {
    display: inline;
}

/* Description */
.custom-scrollbar-fields-description {
    margin-bottom: 0;
}
/* Field Container */
.custom-scrollbar-field {
    float: left;
    clear: both;
    display: inline-block;
    margin: 1px 0;
}
.custom-scrollbar-field label{
    display: inline-block; /* for WordPress v3.7.x or below */
    width: 100%;
}
.custom-scrollbar-field .custom-scrollbar-input-label-container {
    margin-bottom: 0.25em;
}
@media only screen and ( max-width: 780px ) { /* For WordPress v3.8 or greater */
    .custom-scrollbar-field .custom-scrollbar-input-label-container {
        margin-bottom: 0.5em;
    }
}     

.custom-scrollbar-field .custom-scrollbar-input-label-string {
    padding-right: 1em; /* for checkbox label strings, a right padding is needed */
    vertical-align: middle; 
    display: inline-block; /* each (sub)field label can have a fix min-width */
}
.custom-scrollbar-field .custom-scrollbar-input-button-container {
    padding-right: 1em; 
}
.custom-scrollbar-field .custom-scrollbar-input-container {
    display: inline-block;
    vertical-align: middle;
}
.custom-scrollbar-field-image .custom-scrollbar-input-label-container {     
    vertical-align: middle;
}

.custom-scrollbar-field .custom-scrollbar-input-label-container {
    display: inline-block;     
    vertical-align: middle; 
}

/* Repeatable Fields */     
.repeatable .custom-scrollbar-field {
    clear: both;
    display: block;
}
.custom-scrollbar-repeatable-field-buttons {
    float: right;     
    margin: 0.1em 0 0.5em 0.3em;
    vertical-align: middle;
}
.custom-scrollbar-repeatable-field-buttons .repeatable-field-button {
    margin: 0 0.1em;
    font-weight: normal;
    vertical-align: middle;
    text-align: center;
}
@media only screen and (max-width: 960px) {
    .custom-scrollbar-repeatable-field-buttons {
        margin-top: 0;
    }
}

/* Sortable Section and Fields */
.custom-scrollbar-sections.sortable-section > .custom-scrollbar-section,
.sortable .custom-scrollbar-field {
    clear: both;
    float: left;
    display: inline-block;
    padding: 1em 1.2em 0.78em;
    margin: 1px 0 0 0;
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;     
    text-shadow: #fff 0 1px 0;
    -webkit-box-shadow: 0 1px 0 #fff;
    box-shadow: 0 1px 0 #fff;
    -webkit-box-shadow: inset 0 1px 0 #fff;
    box-shadow: inset 0 1px 0 #fff;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background: #f1f1f1;
    background-image: -webkit-gradient(linear, left bottom, left top, from(#ececec), to(#f9f9f9));
    background-image: -webkit-linear-gradient(bottom, #ececec, #f9f9f9);
    background-image: -moz-linear-gradient(bottom, #ececec, #f9f9f9);
    background-image: -o-linear-gradient(bottom, #ececec, #f9f9f9);
    background-image: linear-gradient(to top, #ececec, #f9f9f9);
    border: 1px solid #CCC;
    background: #F6F6F6;    
}     
.custom-scrollbar-fields.sortable {
    margin-bottom: 1.2em; /* each sortable field does not have a margin bottom so this rule gives a margin between the fields and the description */
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

/* Media Upload Buttons */
.custom-scrollbar-field .button.button-small {
    width: auto;
}
 
/* Fonts */
.font-lighter {
    font-weight: lighter;
}

/* Dashicons */ 
.custom-scrollbar-field .button.button-small.dashicons {
    font-size: 1.2em;
    padding-left: 0.2em;
    padding-right: 0.22em;

}
CSSRULES;
        
    }
    static private function _getCollapsibleSectionsRules() {
        $_sCSSRules = <<<CSSRULES
/* Collapsible Sections Title Block */            
.custom-scrollbar-collapsible-sections-title, 
.custom-scrollbar-collapsible-section-title
{
    font-size:13px;
    background-color: #fff;
    padding: 15px 18px;
    margin-top: 1em; 
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
}

.custom-scrollbar-collapsible-sections-title.collapsed
.custom-scrollbar-collapsible-section-title.collapsed {
    border-bottom: 1px solid #dfdfdf;
    margin-bottom: 1em; /* gives a margin for the debug info at the bottom of the meta box */
}
.custom-scrollbar-collapsible-section-title {
    margin-top: 0;
}
.custom-scrollbar-collapsible-section-title.collapsed {
    margin-bottom: 0;
}

/* Collapsible Sections Title Block in Meta Boxes */            
#poststuff .metabox-holder .custom-scrollbar-collapsible-sections-title.custom-scrollbar-section-title h3,
#poststuff .metabox-holder .custom-scrollbar-collapsible-section-title.custom-scrollbar-section-title h3
{
    font-size: 1em;
    margin: 0;
}

/* Collapsible Sections Title Dashicon */            
.custom-scrollbar-collapsible-sections-title.accordion-section-title:after,
.custom-scrollbar-collapsible-section-title.accordion-section-title:after 
{
    top: 12px;
    right: 15px;
}
.custom-scrollbar-collapsible-sections-title.accordion-section-title:after,
.custom-scrollbar-collapsible-section-title.accordion-section-title:after {
    content: '\\f142';
}
.custom-scrollbar-collapsible-sections-title.accordion-section-title.collapsed:after,
.custom-scrollbar-collapsible-section-title.accordion-section-title.collapsed:after 
{
    content: '\\f140';
}

/* Collapsible Sections Content Block */            
.custom-scrollbar-collapsible-sections-content, 
.custom-scrollbar-collapsible-section-content
{
    border: 1px solid #dfdfdf;
    border-top: 0;
    background-color: #fff;
    /* margin-bottom: 1em; */  /* gives a margin for the debug info at the bottom of the meta box */
}

tbody.custom-scrollbar-collapsible-content {
    display: table-caption;     /* 'block' will be assigned in JavaScript if the browser is not Chrome */
    padding: 10px 20px 15px 20px;
}
/* Collapsible section containers get this class selector in Google Chrome */
tbody.custom-scrollbar-collapsible-content.table-caption {
    display: table-caption; /* For some reasons, this display mode gives smooth animation in Google Chrome */
}
/* The Toggle All button */
.custom-scrollbar-collapsible-toggle-all-button-container {
    margin-top: 1em;
    margin-bottom: 1em;
    width: 100%;
    display: table; /* if block, it gets hidden inside the section toggle bar */
}
.custom-scrollbar-collapsible-toggle-all-button.button {

    height: 36px;
    line-height: 34px;
    padding: 0 16px 6px;    
    font-size: 20px;    /* Determines the dashicon size  */
    width: auto;
}

/* Repeatable Section buttons inside the collapsible section title block */
.custom-scrollbar-collapsible-section-title .custom-scrollbar-repeatable-section-buttons {
    /* Collapsible section bar has an icon at the right end so the repeatable button needs to be placed before it */
    margin: 0;
    margin-right: 2em; 
    margin-top: -0.32em;
}
/* When a section_title field is in the caption tag, do not set the margin-top to align vertically */
.custom-scrollbar-collapsible-section-title .custom-scrollbar-repeatable-section-buttons.section_title_field_sibling {
    margin-top: 0;
}

.custom-scrollbar-collapsible-section-title .repeatable-section-button {
    background: none;   /* for Wordpress v3.7.x or below, the background image need to be removed as well */
}
CSSRULES;
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= <<<CSSRULES
.custom-scrollbar-collapsible-sections-title.accordion-section-title:after,
.custom-scrollbar-collapsible-section-title.accordion-section-title:after 
{
    content: '';
    top: 18px;
}
.custom-scrollbar-collapsible-sections-title.accordion-section-title.collapsed:after,
.custom-scrollbar-collapsible-section-title.accordion-section-title.collapsed:after 
{
    content: '';
}                 
.custom-scrollbar-collapsible-toggle-all-button.button {
    font-size: 1em;
}

.custom-scrollbar-collapsible-section-title .custom-scrollbar-repeatable-section-buttons {
    top: -8px;
}
CSSRULES;
            
        }
        return $_sCSSRules;
    }
    static private function _getMetaBoxFormRules() {
        return <<<CSSRULES
/* Meta-box form fields */
.postbox .title-colon {
    margin-left: 0.2em;
}
.postbox .custom-scrollbar-section .form-table > tbody > tr > td,
.postbox .custom-scrollbar-section .form-table > tbody > tr > th
{
    display: inline-block;
    width: 100%;
    padding: 0;
    /* 3.4.0+ In IE inline-block does not take effect for td and th so make them float */
    float: right;
    clear: right; 
}

.postbox .custom-scrollbar-field {
    width: 96%; /* Not 100% because it will stick out */
}            

/* Sortable fields do not look well if the width is fully expanded  */
.postbox .sortable .custom-scrollbar-field {
    /* In Firefox, in side meta boxes, the width needs to be smaller for image previews. */
    width: 84%;
}
            
/* Field Titles */             
.postbox .custom-scrollbar-section .form-table > tbody > tr > th {
    font-size: 13px;
    line-height: 1.5;
    margin: 1em 0px;    
    font-weight: 700;
}

/* Post Metabox Section Heading Info */
#poststuff .metabox-holder .custom-scrollbar-section-title h3 {
    border: none;
    font-weight: bold;
    font-size: 1.2em;
    margin: 1em 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;     
    cursor: inherit;     
    -webkit-user-select: inherit;
    -moz-user-select: inherit;
    user-select: inherit;    

    /* v3.5 or below */
    text-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    background: none;
}      
/* Side meta boxes */
@media screen and (min-width: 783px) {    
    /* Fix that the text input fields stick out the meta-box container */
    #poststuff #post-body.columns-2 #side-sortables .postbox .custom-scrollbar-section .form-table input[type=text]{
        width: 98%;
    }
}
   
CSSRULES;
        
    }
    static private function _getWidgetFormRules() {
        return <<<CSSRULES
/* Widget Forms [3.2.0+] */
.widget .custom-scrollbar-section .form-table > tbody > tr > td,
.widget .custom-scrollbar-section .form-table > tbody > tr > th
{
    display: inline-block;
    width: 100%;
    padding: 0;
    /* 3.4.0+ In IE inline-block does not take effect for td and th so make them float */
    float: right;
    clear: right;     
}

.widget .custom-scrollbar-field,
.widget .custom-scrollbar-input-label-container
{
    width: 100%;
}
.widget .sortable .custom-scrollbar-field {
    /* Sortable fields have paddings so the width needs to be adjusted to fit to 100% */
    padding: 4% 4.4% 3.2% 4.4%;
    width: 91.2%;
}
/* Give a slight margin between the input field and buttons */
.widget .custom-scrollbar-field input {
    margin-bottom: 0.1em;
    margin-top: 0.1em;
}

/* Input fields should have 100% width */
.widget .custom-scrollbar-field input[type=text],
.widget .custom-scrollbar-field textarea {
    width: 100%;
}

/* When the screen is less than 782px */ 
@media screen and ( max-width: 782px ) {
    
    /* The framework render fields with table elements and those container border seems to affect the width of fields */
    .widget .custom-scrollbar-fields {
        width: 99.2%;
    }    
    .widget .custom-scrollbar-field input[type='checkbox'], 
    .widget .custom-scrollbar-field input[type='radio'] 
    {
        margin-top: 0;
    }

}
CSSRULES;
        
    }
    static private function _getFieldErrorRules() {
        return <<<CSSRULES
.field-error, 
.section-error
{
  color: red;
  float: left;
  clear: both;
  margin-bottom: 0.5em;
}
.repeatable-section-error,
.repeatable-field-error {
  float: right;
  clear: both;
  color: red;
  margin-left: 1em;
}
CSSRULES;
        
    }
    static private function _getPageLoadStatsRules() {
        return <<<CSSRULES
/* Page Load Stats */
#custom-scrollbar-page-load-stats {
    clear: both;
    display: inline-block;
    width: 100%
}
#custom-scrollbar-page-load-stats li{
    display: inline;
    margin-right: 1em;
}     

/* To give the footer area more space */
#wpbody-content {
    padding-bottom: 140px;
}            
CSSRULES;
        
    }
    static private function _getVersionSpecificRules($sWPVersion) {
        $_sCSSRules = '';
        if (version_compare($sWPVersion, '3.8', '<')) {
            $_sCSSRules.= <<<CSSRULES
.custom-scrollbar-field .remove_value.button.button-small {
    line-height: 1.5em; 
}

/* Fix tinyMCE width in 3.7x or below */
.widget .custom-scrollbar-section table.mceLayout {
    table-layout: fixed;
}
CSSRULES;
            
        }
        if (version_compare($sWPVersion, '3.8', '>=')) {
            $_sCSSRules.= <<<CSSRULES
/* Widget Forms */
.widget .custom-scrollbar-section .form-table th
{
    font-size: 13px;
    font-weight: normal;
    margin-bottom: 0.2em;
}

.widget .custom-scrollbar-section .form-table {
    margin-top: 1em;
}

/* Repeatable field buttons */
.custom-scrollbar-repeatable-field-buttons {
    margin: 2px 0 0 0.3em;
}

/* Fix Sortable fields drag&drop problem in MP6 */ 
    
@media screen and ( max-width: 782px ) {
	.custom-scrollbar-fieldset {
		overflow-x: hidden;
	}
}    
CSSRULES;
            
        }
        return $_sCSSRules;
    }
    static public function getDefaultCSSIE() {
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