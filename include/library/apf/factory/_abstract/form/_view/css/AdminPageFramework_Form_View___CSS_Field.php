<?php
class CustomScrollbar_AdminPageFramework_Form_View___CSS_Field extends CustomScrollbar_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->_getFormFieldRules();
    }
    static private function _getFormFieldRules() {
        return <<<CSSRULES
/* Form Elements */
/* TD paddings when the field title is disabled */
td.custom-scrollbar-field-td-no-title {
    padding-left: 0;
    padding-right: 0;
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
    protected function _getVersionSpecific() {
        $_sCSSRules = '';
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= <<<CSSRULES
.custom-scrollbar-field .remove_value.button.button-small {
    line-height: 1.5em; 
}
CSSRULES;
            
        }
        if (version_compare($GLOBALS['wp_version'], '3.8', '>=')) {
            $_sCSSRules.= <<<CSSRULES
                
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
}