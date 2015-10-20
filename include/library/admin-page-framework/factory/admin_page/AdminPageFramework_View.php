<?php
abstract class CustomScrollbar_AdminPageFramework_View extends CustomScrollbar_AdminPageFramework_Model {
    public function _replyToPrintAdminNotices() {
        if (!$this->_isInThePage()) {
            return;
        }
        foreach ($this->oProp->aAdminNotices as $_aAdminNotice) {
            $_sClassSelectors = $this->oUtil->getClassAttribute($this->oUtil->getElement($_aAdminNotice, array('sClassSelector'), ''), 'notice is-dismissible');
            echo "<div class='{$_sClassSelectors}' id='{$_aAdminNotice['sID']}'>" . "<p>" . $_aAdminNotice['sMessage'] . "</p>" . "</div>";
        }
    }
    public function content($sContent) {
        return $sContent;
    }
}