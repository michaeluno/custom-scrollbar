<?php
abstract class CustomScrollbar_AdminPageFramework_Widget_Model extends CustomScrollbar_AdminPageFramework_Widget_Router {
    function __construct($oProp) {
        parent::__construct($oProp);
        if (did_action('widgets_init')) {
            add_action("set_up_{$this->oProp->sClassName}", array($this, '_replyToRegisterWidget'), 20);
        } else {
            add_action('widgets_init', array($this, '_replyToRegisterWidget'), 20);
        }
        if ($this->oProp->bIsAdmin) {
            add_filter('validation_' . $this->oProp->sClassName, array($this, '_replyToSortInputs'), 1, 3);
        }
    }
    public function _replyToSortInputs($aSubmittedFormData, $aStoredFormData, $oFactory) {
        return $this->_getSortedInputs($aSubmittedFormData);
    }
    public function _replyToRegisterWidget() {
        global $wp_widget_factory;
        if (!is_object($wp_widget_factory)) {
            return;
        }
        $wp_widget_factory->widgets[$this->oProp->sClassName] = new CustomScrollbar_AdminPageFramework_Widget_Factory($this, $this->oProp->sWidgetTitle, $this->oUtil->getAsArray($this->oProp->aWidgetArguments));
        $this->oProp->oWidget = $wp_widget_factory->widgets[$this->oProp->sClassName];
    }
    public function _registerFormElements($aOptions) {
        $this->_loadFieldTypeDefinitions();
        $this->oProp->aOptions = $aOptions;
        $this->oForm->format();
        $this->oForm->applyConditions();
        $this->oForm->setDynamicElements($this->oProp->aOptions);
        $this->_registerFields($this->oForm->aConditionedFields);
    }
}