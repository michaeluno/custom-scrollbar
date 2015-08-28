<?php
class CustomScrollbar_AdminPageFramework_PageLoadInfo_PostType extends CustomScrollbar_AdminPageFramework_PageLoadInfo_Base {
    private static $_oInstance;
    private static $aClassNames = array();
    public static function instantiate($oProp, $oMsg) {
        if (in_array($oProp->sClassName, self::$aClassNames)) return self::$_oInstance;
        self::$aClassNames[] = $oProp->sClassName;
        self::$_oInstance = new CustomScrollbar_AdminPageFramework_PageLoadInfo_PostType($oProp, $oMsg);
        return self::$_oInstance;
    }
    public function _replyToSetPageLoadInfoInFooter() {
        if (isset($_GET['page']) && $_GET['page']) {
            return;
        }
        if (CustomScrollbar_AdminPageFramework_WPUtility::getCurrentPostType() == $this->oProp->sPostType || CustomScrollbar_AdminPageFramework_WPUtility::isPostDefinitionPage($this->oProp->sPostType) || CustomScrollbar_AdminPageFramework_WPUtility::isCustomTaxonomyPage($this->oProp->sPostType)) {
            add_filter('update_footer', array($this, '_replyToGetPageLoadInfo'), 999);
        }
    }
}