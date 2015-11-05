<?php
abstract class CustomScrollbar_AdminPageFramework_Page_View extends CustomScrollbar_AdminPageFramework_Page_Model {
    public function __construct($sOptionKey = null, $sCallerPath = null, $sCapability = 'manage_options', $sTextDomain = 'custom-scrollbar') {
        parent::__construct($sOptionKey, $sCallerPath, $sCapability, $sTextDomain);
        if ($this->oProp->bIsAdminAjax) {
            return;
        }
        new CustomScrollbar_AdminPageFramework_View_PageMetaboxEnabler($this);
    }
    public function _replyToEnqueuePageAssets() {
        new CustomScrollbar_AdminPageFramework_View_Resource($this);
    }
    protected function _renderPage($sPageSlug, $sTabSlug = null) {
        $_oPageRenderer = new CustomScrollbar_AdminPageFramework_View_PageRenderer($this, $sPageSlug, $sTabSlug);
        $_oPageRenderer->render();
    }
}