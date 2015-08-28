<?php
abstract class CustomScrollbar_AdminPageFramework_PostType_Router extends CustomScrollbar_AdminPageFramework_Factory {
    public function _isInThePage() {
        if (!$this->oProp->bIsAdmin) {
            return false;
        }
        if (!in_array($this->oProp->sPageNow, array('edit.php', 'edit-tags.php', 'post.php', 'post-new.php'))) {
            return false;
        }
        return ($this->oUtil->getCurrentPostType() == $this->oProp->sPostType);
    }
}