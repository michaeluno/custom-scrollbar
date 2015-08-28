<?php
class CustomScrollbar_AdminPageFramework_HelpPane_TaxonomyField extends CustomScrollbar_AdminPageFramework_HelpPane_MetaBox {
    public function _replyToRegisterHelpTabTextForMetaBox() {
        $this->_setHelpTab($this->oProp->sMetaBoxID, $this->oProp->sTitle, $this->oProp->aHelpTabText, $this->oProp->aHelpTabTextSide);
    }
}