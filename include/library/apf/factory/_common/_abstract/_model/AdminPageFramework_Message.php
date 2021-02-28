<?php 
/**
	Admin Page Framework v3.8.26 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/custom-scrollbar>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class CustomScrollbar_AdminPageFramework_Message {
    public $aMessages = array();
    public $aDefaults = array('option_updated' => 'The options have been updated.', 'option_cleared' => 'The options have been cleared.', 'export' => 'Export', 'export_options' => 'Export Options', 'import' => 'Import', 'import_options' => 'Import Options', 'submit' => 'Submit', 'import_error' => 'An error occurred while uploading the import file.', 'uploaded_file_type_not_supported' => 'The uploaded file type is not supported: %1$s', 'could_not_load_importing_data' => 'Could not load the importing data.', 'imported_data' => 'The uploaded file has been imported.', 'not_imported_data' => 'No data could be imported.', 'upload_image' => 'Upload Image', 'use_this_image' => 'Use This Image', 'insert_from_url' => 'Insert from URL', 'reset_options' => 'Are you sure you want to reset the options?', 'confirm_perform_task' => 'Please confirm your action.', 'specified_option_been_deleted' => 'The specified options have been deleted.', 'nonce_verification_failed' => 'A problem occurred while processing the form data. Please try again.', 'check_max_input_vars' => 'Not all form fields could not be sent. Please check your server settings of PHP <code>max_input_vars</code> and consult the server administrator to increase the value. <code>max input vars</code>: %1$s. <code>$_POST</code> count: %2$s', 'send_email' => 'Is it okay to send the email?', 'email_sent' => 'The email has been sent.', 'email_scheduled' => 'The email has been scheduled.', 'email_could_not_send' => 'There was a problem sending the email', 'title' => 'Title', 'author' => 'Author', 'categories' => 'Categories', 'tags' => 'Tags', 'comments' => 'Comments', 'date' => 'Date', 'show_all' => 'Show All', 'show_all_authors' => 'Show all Authors', 'powered_by' => 'Thank you for creating with', 'and' => 'and', 'settings' => 'Settings', 'manage' => 'Manage', 'select_image' => 'Select Image', 'upload_file' => 'Upload File', 'use_this_file' => 'Use This File', 'select_file' => 'Select File', 'remove_value' => 'Remove Value', 'select_all' => 'Select All', 'select_none' => 'Select None', 'no_term_found' => 'No term found.', 'select' => 'Select', 'insert' => 'Insert', 'use_this' => 'Use This', 'return_to_library' => 'Return to Library', 'queries_in_seconds' => '%1$s queries in %2$s seconds.', 'out_of_x_memory_used' => '%1$s out of %2$s (%3$s) memory used.', 'peak_memory_usage' => 'Peak memory usage %1$s.', 'initial_memory_usage' => 'Initial memory usage  %1$s.', 'repeatable_section_is_disabled' => 'The ability to repeat sections is disabled.', 'repeatable_field_is_disabled' => 'The ability to repeat fields is disabled.', 'warning_caption' => 'Warning', 'allowed_maximum_number_of_fields' => 'The allowed maximum number of fields is {0}.', 'allowed_minimum_number_of_fields' => 'The allowed minimum number of fields is {0}.', 'add' => 'Add', 'remove' => 'Remove', 'allowed_maximum_number_of_sections' => 'The allowed maximum number of sections is {0}', 'allowed_minimum_number_of_sections' => 'The allowed minimum number of sections is {0}', 'add_section' => 'Add Section', 'remove_section' => 'Remove Section', 'toggle_all' => 'Toggle All', 'toggle_all_collapsible_sections' => 'Toggle all collapsible sections', 'reset' => 'Reset', 'yes' => 'Yes', 'no' => 'No', 'on' => 'On', 'off' => 'Off', 'enabled' => 'Enabled', 'disabled' => 'Disabled', 'supported' => 'Supported', 'not_supported' => 'Not Supported', 'functional' => 'Functional', 'not_functional' => 'Not Functional', 'too_long' => 'Too Long', 'acceptable' => 'Acceptable', 'no_log_found' => 'No log found.', 'method_called_too_early' => 'The method is called too early.', 'debug_info' => 'Debug Info', 'debug' => 'Debug', 'debug_info_will_be_disabled' => 'This information will be disabled when <code>WP_DEBUG</code> is set to <code>false</code> in <code>wp-config.php</code>.', 'click_to_expand' => 'Click here to expand to view the contents.', 'click_to_collapse' => 'Click here to collapse the contents.', 'loading' => 'Loading...', 'please_enable_javascript' => 'Please enable JavaScript for better user experience.', 'submit_confirmation_label' => 'Submit the form.', 'submit_confirmation_error' => 'Please check this box if you want to proceed.', 'import_no_file' => 'No file is selected.',);
    protected $_sTextDomain = 'custom-scrollbar';
    static private $_aInstancesByTextDomain = array();
    public static function getInstance($sTextDomain = 'custom-scrollbar') {
        $_oInstance = isset(self::$_aInstancesByTextDomain[$sTextDomain]) && (self::$_aInstancesByTextDomain[$sTextDomain] instanceof CustomScrollbar_AdminPageFramework_Message) ? self::$_aInstancesByTextDomain[$sTextDomain] : new CustomScrollbar_AdminPageFramework_Message($sTextDomain);
        self::$_aInstancesByTextDomain[$sTextDomain] = $_oInstance;
        return self::$_aInstancesByTextDomain[$sTextDomain];
    }
    public static function instantiate($sTextDomain = 'custom-scrollbar') {
        return self::getInstance($sTextDomain);
    }
    public function __construct($sTextDomain = 'custom-scrollbar') {
        $this->_sTextDomain = $sTextDomain;
        $this->aMessages = array_fill_keys(array_keys($this->aDefaults), null);
    }
    public function getTextDomain() {
        return $this->_sTextDomain;
    }
    public function set($sKey, $sValue) {
        $this->aMessages[$sKey] = $sValue;
    }
    public function get($sKey = '') {
        if (!$sKey) {
            return $this->_getAllMessages();
        }
        return isset($this->aMessages[$sKey]) ? __($this->aMessages[$sKey], $this->_sTextDomain) : __($this->{$sKey}, $this->_sTextDomain);
    }
    private function _getAllMessages() {
        $_aMessages = array();
        foreach ($this->aMessages as $_sLabel => $_sTranslation) {
            $_aMessages[$_sLabel] = $this->get($_sLabel);
        }
        return $_aMessages;
    }
    public function output($sKey) {
        echo $this->get($sKey);
    }
    public function __($sKey) {
        return $this->get($sKey);
    }
    public function _e($sKey) {
        $this->output($sKey);
    }
    public function __get($sPropertyName) {
        return isset($this->aDefaults[$sPropertyName]) ? $this->aDefaults[$sPropertyName] : $sPropertyName;
    }
    private function ___doDummy() {
        __('The options have been updated.', 'custom-scrollbar');
        __('The options have been cleared.', 'custom-scrollbar');
        __('Export', 'custom-scrollbar');
        __('Export Options', 'custom-scrollbar');
        __('Import', 'custom-scrollbar');
        __('Import Options', 'custom-scrollbar');
        __('Submit', 'custom-scrollbar');
        __('An error occurred while uploading the import file.', 'custom-scrollbar');
        __('The uploaded file type is not supported: %1$s', 'custom-scrollbar');
        __('Could not load the importing data.', 'custom-scrollbar');
        __('The uploaded file has been imported.', 'custom-scrollbar');
        __('No data could be imported.', 'custom-scrollbar');
        __('Upload Image', 'custom-scrollbar');
        __('Use This Image', 'custom-scrollbar');
        __('Insert from URL', 'custom-scrollbar');
        __('Are you sure you want to reset the options?', 'custom-scrollbar');
        __('Please confirm your action.', 'custom-scrollbar');
        __('The specified options have been deleted.', 'custom-scrollbar');
        __('A problem occurred while processing the form data. Please try again.', 'custom-scrollbar');
        __('Not all form fields could not be sent. Please check your server settings of PHP <code>max_input_vars</code> and consult the server administrator to increase the value. <code>max input vars</code>: %1$s. <code>$_POST</code> count: %2$s', 'custom-scrollbar');
        __('Is it okay to send the email?', 'custom-scrollbar');
        __('The email has been sent.', 'custom-scrollbar');
        __('The email has been scheduled.', 'custom-scrollbar');
        __('There was a problem sending the email', 'custom-scrollbar');
        __('Title', 'custom-scrollbar');
        __('Author', 'custom-scrollbar');
        __('Categories', 'custom-scrollbar');
        __('Tags', 'custom-scrollbar');
        __('Comments', 'custom-scrollbar');
        __('Date', 'custom-scrollbar');
        __('Show All', 'custom-scrollbar');
        __('Show All Authors', 'custom-scrollbar');
        __('Thank you for creating with', 'custom-scrollbar');
        __('and', 'custom-scrollbar');
        __('Settings', 'custom-scrollbar');
        __('Manage', 'custom-scrollbar');
        __('Select Image', 'custom-scrollbar');
        __('Upload File', 'custom-scrollbar');
        __('Use This File', 'custom-scrollbar');
        __('Select File', 'custom-scrollbar');
        __('Remove Value', 'custom-scrollbar');
        __('Select All', 'custom-scrollbar');
        __('Select None', 'custom-scrollbar');
        __('No term found.', 'custom-scrollbar');
        __('Select', 'custom-scrollbar');
        __('Insert', 'custom-scrollbar');
        __('Use This', 'custom-scrollbar');
        __('Return to Library', 'custom-scrollbar');
        __('%1$s queries in %2$s seconds.', 'custom-scrollbar');
        __('%1$s out of %2$s MB (%3$s) memory used.', 'custom-scrollbar');
        __('Peak memory usage %1$s MB.', 'custom-scrollbar');
        __('Initial memory usage  %1$s MB.', 'custom-scrollbar');
        __('The allowed maximum number of fields is {0}.', 'custom-scrollbar');
        __('The allowed minimum number of fields is {0}.', 'custom-scrollbar');
        __('Add', 'custom-scrollbar');
        __('Remove', 'custom-scrollbar');
        __('The allowed maximum number of sections is {0}', 'custom-scrollbar');
        __('The allowed minimum number of sections is {0}', 'custom-scrollbar');
        __('Add Section', 'custom-scrollbar');
        __('Remove Section', 'custom-scrollbar');
        __('Toggle All', 'custom-scrollbar');
        __('Toggle all collapsible sections', 'custom-scrollbar');
        __('Reset', 'custom-scrollbar');
        __('Yes', 'custom-scrollbar');
        __('No', 'custom-scrollbar');
        __('On', 'custom-scrollbar');
        __('Off', 'custom-scrollbar');
        __('Enabled', 'custom-scrollbar');
        __('Disabled', 'custom-scrollbar');
        __('Supported', 'custom-scrollbar');
        __('Not Supported', 'custom-scrollbar');
        __('Functional', 'custom-scrollbar');
        __('Not Functional', 'custom-scrollbar');
        __('Too Long', 'custom-scrollbar');
        __('Acceptable', 'custom-scrollbar');
        __('No log found.', 'custom-scrollbar');
        __('The method is called too early: %1$s', 'custom-scrollbar');
        __('Debug Info', 'custom-scrollbar');
        __('Click here to expand to view the contents.', 'custom-scrollbar');
        __('Click here to collapse the contents.', 'custom-scrollbar');
        __('Loading...', 'custom-scrollbar');
        __('Please enable JavaScript for better user experience.', 'custom-scrollbar');
        __('Debug', 'custom-scrollbar');
        __('This information will be disabled when <code>WP_DEBUG</code> is set to <code>false</code> in <code>wp-config.php</code>.', 'custom-scrollbar');
        __('The ability to repeat sections is disabled.', 'custom-scrollbar');
        __('The ability to repeat fields is disabled.', 'custom-scrollbar');
        __('Warning.', 'custom-scrollbar');
        __('Submit the form.', 'custom-scrollbar');
        __('Please check this box if you want to proceed.', 'custom-scrollbar');
        __('No file is selected.', 'custom-scrollbar');
    }
    }
    