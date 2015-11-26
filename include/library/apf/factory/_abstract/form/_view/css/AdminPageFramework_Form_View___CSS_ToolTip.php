<?php
class CustomScrollbar_AdminPageFramework_Form_View___CSS_ToolTip extends CustomScrollbar_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return <<<CSSRULES

/* Inside Field Title */        
th > label > span > .custom-scrollbar-form-tooltip {
    margin-top: 1px;
    float: right;
}
.postbox-container th > label > span > .custom-scrollbar-form-tooltip {
    margin-left: 1em;
    float: none;
}
        
/* Regular section titles have + button and collapsible title bar has a triangle icon so give a right margin */
.custom-scrollbar-section-title a.custom-scrollbar-form-tooltip,
.custom-scrollbar-collapsible-title a.custom-scrollbar-form-tooltip {
    margin-left: 1em;
}

/* When it is placed inside h2, h3, h4, the tooltip text becomes large so avoid that */
a.custom-scrollbar-form-tooltip > .custom-scrollbar-form-tooltip-content {
    font-size: 13px;
    font-weight: normal;
}

.custom-scrollbar-section-tab a.custom-scrollbar-form-tooltip {
    margin-left: 0.48em;
    color: #A8A8A8;
    vertical-align: middle;
}     
.custom-scrollbar-section-tab.nav-tab.active a.custom-scrollbar-form-tooltip {
    color: #A8A8A8;
}

/* Dashicon vertical alignment */
.custom-scrollbar-form-tooltip > span {
    margin-bottom: 1px;
    vertical-align: middle;
}

a.custom-scrollbar-form-tooltip {
    outline: none; 
    text-decoration: none;
    cursor: default;
    color: #A8A8A8;
}
a.custom-scrollbar-form-tooltip > .custom-scrollbar-form-tooltip-content > .custom-scrollbar-form-tooltip-title {
    font-weight: bold;
}
a.custom-scrollbar-form-tooltip strong {
    line-height:30px;
}
a.custom-scrollbar-form-tooltip:hover {
    text-decoration: none;
} 
a.custom-scrollbar-form-tooltip > span.custom-scrollbar-form-tooltip-content {

    display: none; 
    padding: 14px 20px 14px;
    margin-top: -30px; 
    margin-left: 28px;
    width: 400px; 
    line-height:16px;
    
    /* High z-index is required to appear over the left side bar menu */
    z-index: 100000;
    
}
a.custom-scrollbar-form-tooltip:hover > span.custom-scrollbar-form-tooltip-content{
    display: inline; 
    position: absolute; 
    color: #111;
    border:1px solid #DCA; 
    background: #FFFFF4;
    
    /* Adjust the position of the tooltip here */
    /* margin-left: -300px; */
}

/* Balloon Style */
/* .callout {
    z-index: 200000;
    position: absolute;
    top: 30px;
    border: 0;
    left: -12px;
}
 */

/* Tooltip Box Shadow */
a.custom-scrollbar-form-tooltip > span.custom-scrollbar-form-tooltip-content {
    border-radius:4px;
    box-shadow: 5px 5px 8px #CCC;
}

CSSRULES;
        
    }
}