<?php
/**
 Admin Page Framework v3.6.0b07 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class CustomScrollbar_AdminPageFramework_WPUtility_Post extends CustomScrollbar_AdminPageFramework_WPUtility_Option {
    static public function getSavedMetaArray($iPostID, array $aKeys) {
        $_aSavedMeta = array();
        foreach ($aKeys as $_sKey) {
            $_aSavedMeta[$_sKey] = get_post_meta($iPostID, $_sKey, true);
        }
        return $_aSavedMeta;
    }
}