<?php
abstract class CustomScrollbar_AdminPageFramework_UserMeta extends CustomScrollbar_AdminPageFramework_UserMeta_Controller {
    static protected $_sFieldsType = 'user_meta';
    public function __construct($sCapability = 'edit_user', $sTextDomain = 'admin-page-framework') {
        $this->oProp = new CustomScrollbar_AdminPageFramework_Property_UserMeta($this, get_class($this), $sCapability, $sTextDomain, self::$_sFieldsType);
        parent::__construct($this->oProp);
        $this->oUtil->addAndDoAction($this, "start_{$this->oProp->sClassName}");
    }
}