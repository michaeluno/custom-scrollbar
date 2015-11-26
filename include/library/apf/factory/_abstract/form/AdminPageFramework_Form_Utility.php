<?php
abstract class CustomScrollbar_AdminPageFramework_Form_Utility extends CustomScrollbar_AdminPageFramework_WPUtility {
    static public function getElementPathAsArray($asPath) {
        if (is_array($asPath)) {
            return;
        }
        return explode('|', $asPath);
    }
    static public function getFormElementPath($asID) {
        return implode('|', self::getAsArray($asID));
    }
    static public function getIDSanitized($asID) {
        return is_scalar($asID) ? self::sanitizeSlug($asID) : self::getAsArray($asID);
    }
}