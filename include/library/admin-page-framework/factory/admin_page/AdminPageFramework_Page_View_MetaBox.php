<?php
abstract class CustomScrollbar_AdminPageFramework_Page_View_MetaBox extends CustomScrollbar_AdminPageFramework_Page_Model {
    public function __construct($sOptionKey = null, $sCallerPath = null, $sCapability = 'manage_options', $sTextDomain = 'admin-page-framework') {
        parent::__construct($sOptionKey, $sCallerPath, $sCapability, $sTextDomain);
        if ($this->oProp->bIsAdminAjax) {
            return;
        }
        add_action('admin_head', array($this, '_replyToEnableMetaBox'));
    }
    protected function _printMetaBox($sContext, $iContainerID) {
        $_sCurrentScreenID = $this->oUtil->getCurrentScreenID();
        if (!isset($GLOBALS['wp_meta_boxes'][$_sCurrentScreenID][$sContext])) {
            return;
        }
        if (count($GLOBALS['wp_meta_boxes'][$_sCurrentScreenID][$sContext]) <= 0) {
            return;
        }
        echo "<div id='postbox-container-{$iContainerID}' class='postbox-container'>";
        do_meta_boxes('', $sContext, null);
        echo "</div>";
    }
    protected function _getNumberOfColumns() {
        $_iColumns = get_current_screen()->get_columns();
        return $_iColumns ? $_iColumns : 1;
    }
    private function _isMetaBoxAdded($sPageSlug = '') {
        if (!isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aMetaBoxForPagesClasses']) || !is_array($GLOBALS['aCustomScrollbar_AdminPageFramework']['aMetaBoxForPagesClasses'])) {
            return false;
        }
        $sPageSlug = $sPageSlug ? $sPageSlug : $this->oUtil->getElement($_GET, 'page', '');
        if (!$sPageSlug) {
            return false;
        }
        foreach ($GLOBALS['aCustomScrollbar_AdminPageFramework']['aMetaBoxForPagesClasses'] as $sClassName => $oMetaBox) {
            if ($this->_isPageOfMetaBox($sPageSlug, $oMetaBox)) {
                return true;
            }
        }
        return false;
    }
    private function _isPageOfMetaBox($sPageSlug, $oMetaBox) {
        if (in_array($sPageSlug, $oMetaBox->oProp->aPageSlugs)) {
            return true;
        }
        if (!array_key_exists($sPageSlug, $oMetaBox->oProp->aPageSlugs)) {
            return false;
        }
        $_aTabs = $oMetaBox->oProp->aPageSlugs[$sPageSlug];
        $_sCurrentTabSlug = $this->oProp->getCurrentTabSlug();
        return ($_sCurrentTabSlug && in_array($_sCurrentTabSlug, $_aTabs));
    }
    public function _replyToEnableMetaBox() {
        if (!$this->oProp->isPageAdded()) {
            return;
        }
        if (!$this->_isMetaBoxAdded()) {
            return;
        }
        $_sCurrentScreenID = $this->oUtil->getCurrentScreenID();
        do_action("add_meta_boxes_{$_sCurrentScreenID}", null);
        do_action('add_meta_boxes', $_sCurrentScreenID, null);
        wp_enqueue_script('postbox');
        add_screen_option('layout_columns', array('max' => 2, 'default' => 2,));
        wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);
        wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
        if (isset($GLOBALS['page_hook'])) {
            add_action("admin_footer-{$GLOBALS['page_hook']}", array($this, '_replyToAddMetaboxScript'));
        }
    }
    public function _replyToAddMetaboxScript() {
        if (isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['bAddedMetaBoxScript']) && $GLOBALS['aCustomScrollbar_AdminPageFramework']['bAddedMetaBoxScript']) {
            return;
        }
        $GLOBALS['aCustomScrollbar_AdminPageFramework']['bAddedMetaBoxScript'] = true;
        $_sScript = <<<JAVASCRIPTS
jQuery( document).ready( function(){ 
    postboxes.add_postbox_toggles( pagenow ); 
});
JAVASCRIPTS;
        echo '<script class="admin-page-framework-insert-metabox-script">' . $_sScript . '</script>';
    }
}