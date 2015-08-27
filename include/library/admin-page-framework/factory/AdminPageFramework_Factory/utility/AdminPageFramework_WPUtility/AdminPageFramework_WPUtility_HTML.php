<?php
/**
 Admin Page Framework v3.6.0b07 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class CustomScrollbar_AdminPageFramework_WPUtility_HTML extends CustomScrollbar_AdminPageFramework_WPUtility_URL {
    static public function getAttributes(array $aAttributes) {
        $_sQuoteCharactor = "'";
        $_aOutput = array();
        foreach ($aAttributes as $_sAttribute => $_mProperty) {
            if (is_scalar($_mProperty)) {
                $_aOutput[] = "{$_sAttribute}={$_sQuoteCharactor}" . esc_attr($_mProperty) . "{$_sQuoteCharactor}";
            }
        }
        return implode(' ', $_aOutput);
    }
    static public function generateAttributes(array $aAttributes) {
        return self::getAttributes($aAttributes);
    }
    static public function getDataAttributes(array $aArray) {
        return self::generateAttributes(self::getDataAttributeArray($aArray));
    }
    static public function generateDataAttributes(array $aArray) {
        return self::getDataAttributes($aArray);
    }
    static public function getHTMLTag($sTagName, array $aAttributes, $sValue = null) {
        $_sTag = tag_escape($sTagName);
        return null === $sValue ? "<" . $_sTag . " " . self::getAttributes($aAttributes) . " />" : "<" . $_sTag . " " . self::getAttributes($aAttributes) . ">" . $sValue . "</{$_sTag}>";
    }
    static public function generateHTMLTag($sTagName, array $aAttributes, $sValue = null) {
        return self::getHTMLTag($sTagName, $aAttributes, $sValue);
    }
}