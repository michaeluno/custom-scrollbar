<?php
abstract class CustomScrollbar_AdminPageFramework_MetaBox_View extends CustomScrollbar_AdminPageFramework_MetaBox_Model {
    public function _replyToPrintMetaBoxContents($oPost, $vArgs) {
        $_aOutput = array();
        $_aOutput[] = wp_nonce_field($this->oProp->sMetaBoxID, $this->oProp->sMetaBoxID, true, false);
        $_oFieldsTable = new CustomScrollbar_AdminPageFramework_FormPart_Table($this->oProp->aFieldTypeDefinitions, $this->_getFieldErrors(), $this->oMsg);
        $_aOutput[] = $_oFieldsTable->getFormTables($this->oForm->aConditionedSections, $this->oForm->aConditionedFields, array($this, '_replyToGetSectionHeaderOutput'), array($this, '_replyToGetFieldOutput'));
        $this->oUtil->addAndDoActions($this, 'do_' . $this->oProp->sClassName, $this);
        echo $this->oUtil->addAndApplyFilters($this, "content_{$this->oProp->sClassName}", $this->content(implode(PHP_EOL, $_aOutput)));
    }
    public function content($sContent) {
        return $sContent;
    }
}