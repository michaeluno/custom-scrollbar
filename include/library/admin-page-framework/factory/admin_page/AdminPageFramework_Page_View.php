<?php
abstract class CustomScrollbar_AdminPageFramework_Page_View extends CustomScrollbar_AdminPageFramework_Page_View_MetaBox {
    protected function _renderPage($sPageSlug, $sTabSlug = null) {
        $this->oUtil->addAndDoActions($this, $this->oUtil->getFilterArrayByPrefix('do_before_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, true), $this); ?>
        <div class="<?php echo esc_attr($this->oProp->sWrapperClassAttribute); ?>">
            <?php
        $sContentTop = $this->_getScreenIcon($sPageSlug);
        $sContentTop.= $this->_getPageHeadingTabs($sPageSlug, $this->oProp->sPageHeadingTabTag);
        $sContentTop.= $this->_getInPageTabs($sPageSlug, $this->oProp->sInPageTabTag);
        echo $this->oUtil->addAndApplyFilters($this, $this->oUtil->getFilterArrayByPrefix('content_top_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, false), $sContentTop); ?>
            <div class="custom-scrollbar-container">    
                <?php
        $this->oUtil->addAndDoActions($this, $this->oUtil->getFilterArrayByPrefix('do_form_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, true), $this);
        $this->_printFormOpeningTag($this->oProp->bEnableForm); ?>
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-<?php echo $this->_getNumberOfColumns(); ?>">
                    <?php
        $this->_printMainPageContent($sPageSlug, $sTabSlug);
        $this->_printMetaBox('side', 1);
        $this->_printMetaBox('normal', 2);
        $this->_printMetaBox('advanced', 3); ?>     
                    </div><!-- #post-body -->    
                </div><!-- #poststuff -->
                
            <?php echo $this->_printFormClosingTag($sPageSlug, $sTabSlug, $this->oProp->bEnableForm); ?>
            </div><!-- .custom-scrollbar-container -->
                
            <?php echo $this->oUtil->addAndApplyFilters($this, $this->oUtil->getFilterArrayByPrefix('content_bottom_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, false), ''); ?>
        </div><!-- .wrap -->
        <?php
        $this->oUtil->addAndDoActions($this, $this->oUtil->getFilterArrayByPrefix('do_after_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, true), $this);
    }
    private function _printMainPageContent($sPageSlug, $sTabSlug) {
        $_bSideMetaboxExists = (isset($GLOBALS['wp_meta_boxes'][$GLOBALS['page_hook']]['side']) && count($GLOBALS['wp_meta_boxes'][$GLOBALS['page_hook']]['side']) > 0);
        echo "<!-- main admin page content -->";
        echo "<div class='custom-scrollbar-content'>";
        if ($_bSideMetaboxExists) {
            echo "<div id='post-body-content'>";
        }
        $_sContent = call_user_func_array(array($this, 'content'), array($this->_getMainPageContentOutput($sPageSlug)));
        echo $this->oUtil->addAndApplyFilters($this, $this->oUtil->getFilterArrayByPrefix('content_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, false), $_sContent);
        $this->oUtil->addAndDoActions($this, $this->oUtil->getFilterArrayByPrefix('do_', $this->oProp->sClassName, $sPageSlug, $sTabSlug, true), $this);
        if ($_bSideMetaboxExists) {
            echo "</div><!-- #post-body-content -->";
        }
        echo "</div><!-- .custom-scrollbar-content -->";
    }
    private function _getMainPageContentOutput($sPageSlug) {
        ob_start();
        echo $this->_getFormOutput($sPageSlug);
        $_sContent = ob_get_contents();
        ob_end_clean();
        return $_sContent;
    }
    private function _getFormOutput($sPageSlug) {
        if (!$this->oProp->bEnableForm) {
            return '';
        }
        if (!$this->oForm->isPageAdded($sPageSlug)) {
            return '';
        }
        $this->aFieldErrors = isset($this->aFieldErrors) ? $this->aFieldErrors : $this->_getFieldErrors($sPageSlug);
        $_oFieldsTable = new CustomScrollbar_AdminPageFramework_FormPart_Table($this->oProp->aFieldTypeDefinitions, $this->aFieldErrors, $this->oMsg);
        return $_oFieldsTable->getFormTables($this->oForm->aConditionedSections, $this->oForm->aConditionedFields, array($this, '_replyToGetSectionHeaderOutput'), array($this, '_replyToGetFieldOutput'));
    }
    private function _printFormOpeningTag($fEnableForm = true) {
        if (!$fEnableForm) {
            return;
        }
        echo "<form " . $this->oUtil->getAttributes(array('method' => 'post', 'enctype' => $this->oProp->sFormEncType, 'id' => 'custom-scrollbar-form', 'action' => wp_unslash(remove_query_arg('settings-updated', $this->oProp->sTargetFormPage)),)) . " >" . PHP_EOL;
        echo "<input type='hidden' name='admin_page_framework_start' value='1' />" . PHP_EOL;
        settings_fields($this->oProp->sOptionKey);
    }
    private function _printFormClosingTag($sPageSlug, $sTabSlug, $fEnableForm = true) {
        if (!$fEnableForm) {
            return;
        }
        $_sNonceTransientKey = 'form_' . md5($this->oProp->sClassName . get_current_user_id());
        $_sNonce = $this->oUtil->getTransient($_sNonceTransientKey, '_admin_page_framework_form_nonce_' . uniqid());
        $this->oUtil->setTransient($_sNonceTransientKey, $_sNonce, 60 * 60);
        echo "<input type='hidden' name='page_slug' value='{$sPageSlug}' />" . PHP_EOL . "<input type='hidden' name='tab_slug' value='{$sTabSlug}' />" . PHP_EOL . "<input type='hidden' name='_is_admin_page_framework' value='{$_sNonce}' />" . PHP_EOL . "</form><!-- End Form -->" . PHP_EOL;
    }
    private function _getScreenIcon($sPageSlug) {
        try {
            $this->_throwScreenIconByURLOrPath($sPageSlug);
            $this->_throwScreenIconByID($sPageSlug);
        }
        catch(Exception $_oException) {
            return $_oException->getMessage();
        }
        return $this->_getDefaultScreenIcon();
    }
    private function _throwScreenIconByURLOrPath($sPageSlug) {
        if (!isset($this->oProp->aPages[$sPageSlug]['href_icon_32x32'])) {
            return;
        }
        $_aAttributes = array('style' => $this->oUtil->generateInlineCSS(array('background-image' => "url('" . esc_url($this->oProp->aPages[$sPageSlug]['href_icon_32x32']) . "')")));
        throw new Exception($this->_getScreenIconByAttributes($_aAttributes));
    }
    private function _throwScreenIconByID($sPageSlug) {
        if (!isset($this->oProp->aPages[$sPageSlug]['screen_icon_id'])) {
            return;
        }
        $_aAttributes = array('id' => "icon-" . $this->oProp->aPages[$sPageSlug]['screen_icon_id'],);
        throw new Exception($this->_getScreenIconByAttributes($_aAttributes));
    }
    private function _getDefaultScreenIcon() {
        $_oScreen = get_current_screen();
        $_sIconIDAttribute = $this->_getScreenIDAttribute($_oScreen);
        $_aAttributes = array('class' => $this->oUtil->getClassAttribute($this->oUtil->getAOrB(empty($_sIconIDAttribute) && $_oScreen->post_type, sanitize_html_class('icon32-posts-' . $_oScreen->post_type), ''), $this->oUtil->getAOrB(empty($_sIconIDAttribute) || $_sIconIDAttribute == $this->oProp->sClassName, 'generic', '')), 'id' => "icon-" . $_sIconIDAttribute,);
        return $this->_getScreenIconByAttributes($_aAttributes);
    }
    private function _getScreenIDAttribute($oScreen) {
        if (!empty($oScreen->parent_base)) {
            return $oScreen->parent_base;
        }
        if ('page' === $oScreen->post_type) {
            return 'edit-pages';
        }
        return esc_attr($oScreen->base);
    }
    private function _getScreenIconByAttributes(array $aAttributes) {
        $aAttributes['class'] = $this->oUtil->getClassAttribute('icon32', $this->oUtil->getElement($aAttributes, 'class'));
        return "<div " . $this->oUtil->getAttributes($aAttributes) . ">" . "<br />" . "</div>";
    }
    private function _getPageHeadingTabs($sCurrentPageSlug, $sTag = 'h2') {
        $_aPage = $this->oProp->aPages[$sCurrentPageSlug];
        if (!$_aPage['show_page_title']) {
            return "";
        }
        $sTag = $this->_getPageHeadingTabTag($sTag, $_aPage);
        if (!$_aPage['show_page_heading_tabs'] || count($this->oProp->aPages) == 1) {
            return "<{$sTag}>" . $_aPage['title'] . "</{$sTag}>";
        }
        return $this->_getPageHeadingtabNavigationBar($this->oProp->aPages, $sTag, $sCurrentPageSlug);
    }
    private function _getPageHeadingTabTag($sTag, array $aPage) {
        return tag_escape($aPage['page_heading_tab_tag'] ? $aPage['page_heading_tab_tag'] : $sTag);
    }
    private function _getPageHeadingtabNavigationBar(array $aPages, $sTag, $sCurrentPageSlug) {
        $_oTabBar = new CustomScrollbar_AdminPageFramework_TabNavigationBar($aPages, $sCurrentPageSlug, $sTag, array(), array('format' => array($this, '_replyToFormatNavigationTabItem_PageHeadingTab'),));
        $_sTabBar = $_oTabBar->get();
        return $_sTabBar ? "<div class='custom-scrollbar-page-heading-tab'>" . $_sTabBar . "</div>" : '';
    }
    public function _replyToFormatNavigationTabItem_PageHeadingTab($aSubPage, $aStructure, $aPages, $aArguments = array()) {
        switch ($aSubPage['type']) {
            case 'link':
                return $this->_getFormattedPageHeadingtabNavigationBarLinkItem($aSubPage, $aStructure);
            default:
                return $this->_getFormattedPageHeadingtabNavigationBarPageItem($aSubPage, $aStructure);
        }
        return $aSubPage + $aStructure;
    }
    private function _getFormattedPageHeadingtabNavigationBarPageItem(array $aSubPage, $aStructure) {
        if (!isset($aSubPage['page_slug'])) {
            return array();
        }
        if (!$aSubPage['show_page_heading_tab']) {
            return array();
        }
        return array('slug' => $aSubPage['page_slug'], 'title' => $aSubPage['title'], 'href' => esc_url($this->oUtil->getQueryAdminURL(array('page' => $aSubPage['page_slug'], 'tab' => false,), $this->oProp->aDisallowedQueryKeys)),) + $aSubPage + array('class' => null) + $aStructure;
    }
    private function _getFormattedPageHeadingtabNavigationBarLinkItem(array $aSubPage, $aStructure) {
        if (!isset($aSubPage['href'])) {
            return array();
        }
        if (!$aSubPage['show_page_heading_tab']) {
            return array();
        }
        $aSubPage = array('slug' => $aSubPage['href'], 'title' => $aSubPage['title'], 'href' => esc_url($aSubPage['href']),) + $aSubPage + array('class' => null) + $aStructure;
        $aSubPage['class'] = trim($aSubPage['class'] . ' link');
        return $aSubPage;
    }
    private function _getInPageTabs($sCurrentPageSlug, $sTag = 'h3') {
        $_aInPageTabs = $this->oUtil->getElement($this->oProp->aInPageTabs, $sCurrentPageSlug, array());
        if (empty($_aInPageTabs)) {
            return '';
        }
        $_aPage = $this->oProp->aPages[$sCurrentPageSlug];
        $_sCurrentTabSlug = $this->_getCurrentTabSlug($sCurrentPageSlug);
        $_sTag = $this->_getInPageTabTag($sTag, $_aPage);
        if (!$_aPage['show_in_page_tabs']) {
            return isset($_aInPageTabs[$_sCurrentTabSlug]['title']) ? "<{$_sTag}>" . $_aInPageTabs[$_sCurrentTabSlug]['title'] . "</{$_sTag}>" : "";
        }
        return $this->_getInPageTabNavigationBar($_aInPageTabs, $_sCurrentTabSlug, $sCurrentPageSlug, $_sTag);
    }
    private function _getInPageTabNavigationBar(array $aTabs, $sActiveTab, $sCurrentPageSlug, $sTag) {
        $_oTabBar = new CustomScrollbar_AdminPageFramework_TabNavigationBar($aTabs, $sActiveTab, $sTag, array('class' => 'in-page-tab',), array('format' => array($this, '_replyToFormatNavigationTabItem_InPageTab'), 'arguments' => array('page_slug' => $sCurrentPageSlug,),));
        $_sTabBar = $_oTabBar->get();
        return $_sTabBar ? "<div class='custom-scrollbar-in-page-tab'>" . $_sTabBar . "</div>" : '';
    }
    public function _replyToFormatNavigationTabItem_InPageTab(array $aTab, array $aStructure, array $aTabs, array $aArguments = array()) {
        $_oFormatter = new CustomScrollbar_AdminPageFramework_Format_NavigationTab_InPageTab($aTab, $aStructure, $aTabs, $aArguments, $this);
        return $_oFormatter->get();
    }
    private function _getInPageTabTag($sTag, array $aPage) {
        return tag_escape($aPage['in_page_tab_tag'] ? $aPage['in_page_tab_tag'] : $sTag);
    }
    private function _getCurrentTabSlug($sCurrentPageSlug) {
        $_sCurrentTabSlug = $this->oUtil->getElement($_GET, 'tab', $this->oProp->getDefaultInPageTab($sCurrentPageSlug));
        $_sTabSlug = $this->_getParentTabSlug($sCurrentPageSlug, $_sCurrentTabSlug);
        return $_sTabSlug;
    }
    private function _getParentTabSlug($sPageSlug, $sTabSlug) {
        $_sParentTabSlug = $this->oUtil->getElement($this->oProp->aInPageTabs, array($sPageSlug, $sTabSlug, 'parent_tab_slug'), $sTabSlug);
        return isset($this->oProp->aInPageTabs[$sPageSlug][$_sParentTabSlug]['show_in_page_tab']) && $this->oProp->aInPageTabs[$sPageSlug][$_sParentTabSlug]['show_in_page_tab'] ? $_sParentTabSlug : $sTabSlug;
    }
}