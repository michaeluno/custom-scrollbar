<?php
class CustomScrollbar_AdminPageFramework_WPUtility extends CustomScrollbar_AdminPageFramework_WPUtility_SystemInformation {
    static public function getWPAdminDirPath() {
        $_aFunctionNames = array(0 => 'get_admin_url', 1 => 'get_network_admin_url');
        $_sWPAdminPath = str_replace(get_bloginfo('url') . '/', ABSPATH, call_user_func($_aFunctionNames[( integer )is_network_admin() ]));
        return rtrim($_sWPAdminPath, '/');
    }
    static public function goToLocalURL($sURL, $oCallbackOnError = null) {
        self::redirectByType($sURL, 1, $oCallbackOnError);
    }
    static public function goToURL($sURL, $oCallbackOnError = null) {
        self::redirectByType($sURL, 0, $oCallbackOnError);
    }
    static public function redirectByType($sURL, $iType = 0, $oCallbackOnError = null) {
        $_iRedirectError = self::getRedirectPreError($sURL, $iType);
        if ($_iRedirectError && is_callable($oCallbackOnError)) {
            call_user_func_array($oCallbackOnError, array($_iRedirectError, $sURL,));
            return;
        }
        $_sFunctionName = array(0 => 'wp_redirect', 1 => 'wp_safe_redirect',);
        exit($_sFunctionName[( integer )$iType]($sURL));
    }
    static public function getRedirectPreError($sURL, $iType) {
        if (!$iType && filter_var($sURL, FILTER_VALIDATE_URL) === false) {
            return 1;
        }
        if (headers_sent()) {
            return 2;
        }
        return 0;
    }
    static public function isDebugMode() {
        return defined('WP_DEBUG') && WP_DEBUG;
    }
    static public function isDoingAjax() {
        return defined('DOING_AJAX') && DOING_AJAX;
    }
    static public function flushRewriteRules() {
        if (self::$_bIsFlushed) {
            return;
        }
        flush_rewrite_rules();
        self::$_bIsFlushed = true;
    }
    static private $_bIsFlushed = false;
}