<?php
class CustomScrollbar_AdminPageFramework_WPReadmeParser {
    static private $_aStructure_Callbacks = array('code_block' => null, '%PLUGIN_DIR_URL%' => null, '%WP_ADMIN_URL%' => null,);
    public function __construct($sFilePath = '', array $aReplacements = array(), array $aCallbacks = array()) {
        $this->sText = file_exists($sFilePath) ? file_get_contents($sFilePath) : '';
        $this->_aSections = $this->sText ? $this->_getSplitContentsBySection($this->sText) : array();
        $this->aReplacements = $aReplacements;
        $this->aCallbacks = $aCallbacks + self::$_aStructure_Callbacks;
    }
    public function setText($sText) {
        $this->sText = $sText;
        $this->_aSections = $this->sText ? $this->_getSplitContentsBySection($this->sText) : array();
    }
    private function _getSplitContentsBySection($sText) {
        return preg_split('/^[\s]*==[\s]*(.+?)[\s]*==/m', $sText, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    }
    public function get($sSectionName = '') {
        return $sSectionName ? $this->getSection($sSectionName) : $this->_getParsedText($this->sText);
    }
    public function getSection($sSectionName) {
        $_sContent = $this->getRawSection($sSectionName);
        return $this->_getParsedText($_sContent);
    }
    private function _getParsedText($sContent) {
        $_sContent = preg_replace('/`(.*?)`/', '<code>\\1</code>', $sContent);
        $_sContent = preg_replace_callback('/`(.*?)`/ms', array($this, '_replyToReplaceCodeBlocks'), $_sContent);
        $_sContent = preg_replace('/= (.*?) =/', '<h4>\\1</h4>', $_sContent);
        $_sContent = str_replace(array_keys($this->aReplacements), array_values($this->aReplacements), $_sContent);
        $_oParsedown = new CustomScrollbar_AdminPageFramework_Parsedown();
        return $_oParsedown->text($_sContent);
    }
    public function _replyToReplaceCodeBlocks($aMatches) {
        if (!isset($aMatches[1])) {
            return $aMatches[0];
        }
        $_sIntact = trim($aMatches[1]);
        $_sModified = "<pre><code>" . $this->getSyntaxHighlightedPHPCode($_sIntact) . "</code></pre>";
        return is_callable($this->aCallbacks['code_block']) ? call_user_func_array($this->aCallbacks['code_block'], array($_sModified, $_sIntact)) : $_sModified;
    }
    public function getRawSection($sSectionName) {
        $_iIndex = array_search($sSectionName, $this->_aSections);
        return false === $_iIndex ? '' : trim($this->_aSections[$_iIndex + 1]);
    }
    public function getSyntaxHighlightedPHPCode($sCode) {
        $_bHasPHPTag = "<?php" === substr($sCode, 0, 5);
        $sCode = $_bHasPHPTag ? $sCode : "<?php " . $sCode;
        $sCode = str_replace('"', "'", $sCode);
        $sCode = highlight_string($sCode, true);
        $sCode = $_bHasPHPTag ? $sCode : preg_replace('/(&lt;|<)\Q?php\E(&nbsp;)?/', '', $sCode, 1);
        return $sCode;
    }
}