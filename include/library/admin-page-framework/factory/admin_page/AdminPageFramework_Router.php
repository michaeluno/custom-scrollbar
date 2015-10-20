<?php
abstract class CustomScrollbar_AdminPageFramework_Router extends CustomScrollbar_AdminPageFramework_Factory {
    function __construct($sOptionKey = null, $sCallerPath = null, $sCapability = 'manage_options', $sTextDomain = 'custom-scrollbar') {
        $this->oProp = isset($this->oProp) ? $this->oProp : new CustomScrollbar_AdminPageFramework_Property_Page($this, $sCallerPath, get_class($this), $sOptionKey, $sCapability, $sTextDomain);
        parent::__construct($this->oProp);
        if ($this->oProp->bIsAdminAjax) {
            return;
        }
        if ($this->oProp->bIsAdmin) {
            add_action('wp_loaded', array($this, 'setup_pre'));
        }
    }
    public function __call($sMethodName, $aArgs = null) {
        $_sPageSlug = $this->oProp->getCurrentPageSlug();
        $_sTabSlug = $this->oProp->getCurrentTabSlug($_sPageSlug);
        $_mFirstArg = $this->oUtil->getElement($aArgs, 0);
        $_aKnownMethodPrefixes = array('section_pre_', 'field_pre_', 'load_pre_',);
        switch ($this->_getCallbackName($sMethodName, $_sPageSlug, $_aKnownMethodPrefixes)) {
            case 'setup_pre':
                $this->_doSetUp();
                return;
            case $this->oProp->sClassHash . '_page_' . $_sPageSlug:
                return $this->_renderPage($_sPageSlug, $_sTabSlug);
            case 'section_pre_':
                return $this->_renderSectionDescription($sMethodName);
            case 'field_pre_':
                return $this->_renderSettingField($_mFirstArg, $_sPageSlug);
            case 'load_pre_':
                return $this->_doPageLoadCall($sMethodName, $_sPageSlug, $_sTabSlug, $_mFirstArg);
            default:
                return parent::__call($sMethodName, $aArgs);
        }
    }
    private function _getCallbackName($sMethodName, $sPageSlug, array $aKnownMethodPrefixes = array()) {
        if (in_array($sMethodName, array('setup_pre', $this->oProp->sClassHash . '_page_' . $sPageSlug))) {
            return $sMethodName;
        }
        foreach ($aKnownMethodPrefixes as $_sMethodPrefix) {
            if ($this->oUtil->hasPrefix($_sMethodPrefix, $sMethodName)) {
                return $_sMethodPrefix;
            }
        }
        return '';
    }
    private function _doSetUp() {
        $this->_setUp();
        $this->oUtil->addAndDoAction($this, "set_up_{$this->oProp->sClassName}", $this);
        $this->oProp->_bSetupLoaded = true;
    }
    protected function _doPageLoadCall($sMethodName, $sPageSlug, $sTabSlug, $oScreen) {
        if (!$this->isPageLoadCall($sMethodName, $sPageSlug, $oScreen->id)) {
            return;
        }
        $this->oForm->aSections['_default']['page_slug'] = $sPageSlug ? $sPageSlug : null;
        $this->oForm->aSections['_default']['tab_slug'] = $sTabSlug ? $sTabSlug : null;
        $this->oUtil->addAndDoActions($this, array("load_{$this->oProp->sClassName}", "load_{$sPageSlug}",), $this);
        $this->_finalizeInPageTabs();
        $this->oUtil->addAndDoActions($this, array("load_{$sPageSlug}_" . $this->oProp->getCurrentTabSlug($sPageSlug)), $this);
        $this->oUtil->addAndDoActions($this, array("load_after_{$this->oProp->sClassName}"), $this);
    }
    private function isPageLoadCall($sMethodName, $sPageSlug, $sScreenID) {
        if (substr($sMethodName, strlen('load_pre_')) !== $sPageSlug) {
            return false;
        }
        if (!isset($this->oProp->aPageHooks[$sPageSlug])) {
            return false;
        }
        if ($sScreenID !== $this->oProp->aPageHooks[$sPageSlug]) {
            return false;
        }
        return true;
    }
    protected function _isInstantiatable() {
        if (isset($GLOBALS['pagenow']) && 'admin-ajax.php' === $GLOBALS['pagenow']) {
            return false;
        }
        return !is_network_admin();
    }
    public function _isInThePage($aPageSlugs = array()) {
        if (!isset($this->oProp)) {
            return true;
        }
        if (!$this->oProp->_bSetupLoaded) {
            return true;
        }
        if (!isset($_GET['page'])) {
            return false;
        }
        $_oScreen = get_current_screen();
        if (is_object($_oScreen)) {
            return in_array($_oScreen->id, $this->oProp->aPageHooks);
        }
        if (empty($aPageSlugs)) {
            return $this->oProp->isPageAdded();
        }
        return in_array($_GET['page'], $aPageSlugs);
    }
}