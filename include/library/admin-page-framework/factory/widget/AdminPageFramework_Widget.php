<?php
abstract class CustomScrollbar_AdminPageFramework_Widget extends CustomScrollbar_AdminPageFramework_Widget_Controller {
    static protected $_sFieldsType = 'widget';
    public function __construct($sWidgetTitle, $aWidgetArguments = array(), $sCapability = 'edit_theme_options', $sTextDomain = 'admin-page-framework') {
        if (empty($sWidgetTitle)) {
            return;
        }
        $this->oProp = new CustomScrollbar_AdminPageFramework_Property_Widget($this, null, get_class($this), $sCapability, $sTextDomain, self::$_sFieldsType);
        $this->oProp->sWidgetTitle = $sWidgetTitle;
        $this->oProp->aWidgetArguments = $aWidgetArguments;
        parent::__construct($this->oProp);
        $this->oUtil->addAndDoAction($this, "start_{$this->oProp->sClassName}", $this);
    }
}