<?php
class CustomScrollbar_AdminPageFramework_Form_View extends CustomScrollbar_AdminPageFramework_Form_Model {
    public function __construct() {
        parent::__construct();
        new CustomScrollbar_AdminPageFramework_Form_View__Resource($this);
    }
    public function get() {
        $this->sCapability = $this->callBack($this->aCallbacks['capability'], '');
        if (!$this->canUserView($this->sCapability)) {
            return '';
        }
        $this->_formatElementDefinitions($this->aSavedData);
        new CustomScrollbar_AdminPageFramework_Form_View___Script_Form;
        $_oFormTables = new CustomScrollbar_AdminPageFramework_Form_View___Sectionsets(array('capability' => $this->sCapability,) + $this->aArguments, array('field_type_definitions' => $this->aFieldTypeDefinitions, 'sectionsets' => $this->aSectionsets, 'fieldsets' => $this->aFieldsets,), $this->aSavedData, $this->getFieldErrors(), $this->aCallbacks, $this->oMsg);
        return $this->_getNoScriptMessage() . $_oFormTables->get();
    }
    private function _getNoScriptMessage() {
        if ($this->hasBeenCalled(__METHOD__)) {
            return;
        }
        return "<noscript>" . "<div class='error'>" . "<p class='custom-scrollbar-form-warning'>" . $this->oMsg->get('please_enable_javascript') . "</p>" . "</div>" . "</noscript>";
    }
    public function printSubmitNotices() {
        $this->oSubmitNotice->render();
    }
}