<?php
class CustomScrollbar_AdminPageFramework_Model_FormSubmission_Validator_ResetConfirm extends CustomScrollbar_AdminPageFramework_Model_FormSubmission_Validator_Reset {
    public $sActionHookPrefix = 'try_validation_before_';
    public $iHookPriority = 20;
    public $iCallbackParameters = 5;
    public function _replyToCallback($aInputs, $aRawInputs, array $aSubmits, $aSubmitInformation, $oFactory) {
        $_bIsReset = ( bool )$this->_getPressedSubmitButtonData($aSubmits, 'is_reset');
        if (!$_bIsReset) {
            return;
        }
        add_filter("options_update_status_{$this->oFactory->oProp->sClassName}", array($this, '_replyToSetStatus'));
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $this->_confirmSubmitButtonAction($this->getElement($aSubmitInformation, 'input_name'), $this->getElement($aSubmitInformation, 'section_id'), 'reset');
        throw $_oException;
    }
    public function _replyToSetStatus($aStatus) {
        return array('confirmation' => 'reset') + $aStatus;
    }
}