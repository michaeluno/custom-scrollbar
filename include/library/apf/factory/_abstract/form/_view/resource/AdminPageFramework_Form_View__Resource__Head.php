<?php
class CustomScrollbar_AdminPageFramework_Form_View__Resource__Head extends CustomScrollbar_AdminPageFramework_WPUtility {
    public $oForm;
    public function __construct($oForm, $sHeadActionHook) {
        $this->oForm = $oForm;
        add_action($sHeadActionHook, array($this, '_replyToInsertRequiredInlineScripts'));
    }
    public function _replyToInsertRequiredInlineScripts() {
        if ($this->hasBeenCalled(__METHOD__)) {
            return;
        }
        if (!$this->oForm->isInThePage()) {
            return;
        }
        echo "<script type='text/javascript' class='custom-scrollbar-form-script-required-in-head'>" . '/* <![CDATA[ */ ' . $this->_getScripts_RequiredInHead() . ' /* ]]> */' . "</script>";
    }
    private function _getScripts_RequiredInHead() {
        return 'document.write( "<style class=\'custom-scrollbar-js-embedded-inline-style\'>' . str_replace('\\n', '', esc_js($this->_getInlineCSS())) . '</style>" );';
    }
    private function _getInlineCSS() {
        $_oLoadingCSS = new CustomScrollbar_AdminPageFramework_Form_View___CSS_Loading;
        $_oLoadingCSS->add($this->_getScriptElementConcealerCSSRules());
        return $_oLoadingCSS->get();
    }
    private function _getScriptElementConcealerCSSRules() {
        return <<<CSSRULES
.custom-scrollbar-form-js-on {  
    visibility: hidden;
}
.widget .custom-scrollbar-form-js-on { 
    visibility: visible; 
}
CSSRULES;
        
    }
}