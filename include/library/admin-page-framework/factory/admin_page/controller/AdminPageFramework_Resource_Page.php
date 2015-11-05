<?php
class CustomScrollbar_AdminPageFramework_Resource_Page extends CustomScrollbar_AdminPageFramework_Resource_Base {
    protected function _printClassSpecificStyles($sIDPrefix) {
        static $_bLoaded = false;
        if ($_bLoaded) {
            parent::_printClassSpecificStyles($sIDPrefix);
            return;
        }
        $_bLoaded = true;
        $_oCaller = $this->oProp->_getCallerObject();
        $_sPageSlug = $this->_getCurrentPageSlugForFilter();
        $_sTabSlug = $this->_getCurrentTabSlugForFilter($_sPageSlug);
        if ($_sPageSlug && $_sTabSlug) {
            $this->oProp->sStyle = $this->addAndApplyFilters($_oCaller, "style_{$_sPageSlug}_{$_sTabSlug}", $this->oProp->sStyle);
        }
        if ($_sPageSlug) {
            $this->oProp->sStyle = $this->addAndApplyFilters($_oCaller, "style_{$_sPageSlug}", $this->oProp->sStyle);
        }
        parent::_printClassSpecificStyles($sIDPrefix);
    }
    private function _getCurrentPageSlugForFilter() {
        $_sPageSlug = $this->oProp->getCurrentPageSlug();
        return $this->oProp->isPageAdded($_sPageSlug) ? $_sPageSlug : '';
    }
    private function _getCurrentTabSlugForFilter($sPageSlug) {
        $_sTabSlug = $this->oProp->getCurrentTabSlug($sPageSlug);
        return isset($this->oProp->aInPageTabs[$sPageSlug][$_sTabSlug]) ? $_sTabSlug : '';
    }
    protected function _printClassSpecificScripts($sIDPrefix) {
        static $_bLoaded = false;
        if ($_bLoaded) {
            parent::_printClassSpecificScripts($sIDPrefix);
            return;
        }
        $_bLoaded = true;
        $_oCaller = $this->oProp->_getCallerObject();
        $_sPageSlug = $this->_getCurrentPageSlugForFilter();
        $_sTabSlug = $this->_getCurrentTabSlugForFilter($_sPageSlug);
        if ($_sPageSlug && $_sTabSlug) {
            $this->oProp->sScript = $this->addAndApplyFilters($_oCaller, "script_{$_sPageSlug}_{$_sTabSlug}", $this->oProp->sScript);
        }
        if ($_sPageSlug) {
            $this->oProp->sScript = $this->addAndApplyFilters($_oCaller, "script_{$_sPageSlug}", $this->oProp->sScript);
        }
        parent::_printClassSpecificScripts($sIDPrefix);
    }
    public function _enqueueStyles($aSRCs, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        $_aHandleIDs = array();
        foreach (( array )$aSRCs as $_sSRC) {
            $_aHandleIDs[] = $this->_enqueueStyle($_sSRC, $sPageSlug, $sTabSlug, $aCustomArgs);
        }
        return $_aHandleIDs;
    }
    public function _enqueueStyle($sSRC, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        return $this->_enqueueResourceByType($sSRC, $sPageSlug, $sTabSlug, $aCustomArgs, 'style');
    }
    public function _enqueueScripts($aSRCs, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        $_aHandleIDs = array();
        foreach (( array )$aSRCs as $_sSRC) {
            $_aHandleIDs[] = $this->_enqueueScript($_sSRC, $sPageSlug, $sTabSlug, $aCustomArgs);
        }
        return $_aHandleIDs;
    }
    public function _enqueueScript($sSRC, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        return $this->_enqueueResourceByType($sSRC, $sPageSlug, $sTabSlug, $aCustomArgs, 'script');
    }
    private function _enqueueResourceByType($sSRC, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array(), $sType = 'style') {
        $sSRC = trim($sSRC);
        if (empty($sSRC)) {
            return '';
        }
        $sSRC = $this->getResolvedSRC($sSRC);
        $_sContainerPropertyName = $this->_getContainerPropertyNameByType($sType);
        $_sEnqueuedIndexPropertyName = $this->_getEnqueuedIndexPropertyNameByType($sType);
        $_sSRCHash = md5($sSRC);
        if (isset($this->oProp->{$_sContainerPropertyName}[$_sSRCHash])) {
            return '';
        }
        $this->oProp->{$_sContainerPropertyName}[$_sSRCHash] = array_filter($this->getAsArray($aCustomArgs), array($this, 'isNotNull')) + array('sPageSlug' => $sPageSlug, 'sTabSlug' => $sTabSlug, 'sSRC' => $sSRC, 'sType' => $sType, 'handle_id' => $sType . '_' . $this->oProp->sClassName . '_' . (++$this->oProp->{$_sEnqueuedIndexPropertyName}),) + self::$_aStructure_EnqueuingResources;
        $this->oProp->aResourceAttributes[$this->oProp->{$_sContainerPropertyName}[$_sSRCHash]['handle_id']] = $this->oProp->{$_sContainerPropertyName}[$_sSRCHash]['attributes'];
        return $this->oProp->{$_sContainerPropertyName}[$_sSRCHash]['handle_id'];
    }
    private function _getContainerPropertyNameByType($sType) {
        switch ($sType) {
            default:
            case 'style':
                return 'aEnqueuingStyles';
            case 'script':
                return 'aEnqueuingScripts';
        }
    }
    private function _getEnqueuedIndexPropertyNameByType($sType) {
        switch ($sType) {
            default:
            case 'style':
                return 'iEnqueuedStyleIndex';
            case 'script':
                return 'iEnqueuedScriptIndex';
        }
    }
    public function _forceToEnqueueStyle($sSRC, $aCustomArgs = array()) {
        return $this->_enqueueStyle($sSRC, '', '', $aCustomArgs);
    }
    public function _forceToEnqueueScript($sSRC, $aCustomArgs = array()) {
        return $this->_enqueueScript($sSRC, '', '', $aCustomArgs);
    }
    protected function _enqueueSRCByConditoin($aEnqueueItem) {
        $sCurrentPageSlug = $this->oProp->getCurrentPageSlug();
        $sCurrentTabSlug = $this->oProp->getCurrentTabSlug($sCurrentPageSlug);
        $sPageSlug = $aEnqueueItem['sPageSlug'];
        $sTabSlug = $aEnqueueItem['sTabSlug'];
        if (!$sPageSlug && $this->oProp->isPageAdded($sCurrentPageSlug)) {
            return $this->_enqueueSRC($aEnqueueItem);
        }
        if (($sPageSlug && $sCurrentPageSlug == $sPageSlug) && ($sTabSlug && $sCurrentTabSlug == $sTabSlug)) {
            return $this->_enqueueSRC($aEnqueueItem);
        }
        if (($sPageSlug && !$sTabSlug) && ($sCurrentPageSlug == $sPageSlug)) {
            return $this->_enqueueSRC($aEnqueueItem);
        }
    }
}