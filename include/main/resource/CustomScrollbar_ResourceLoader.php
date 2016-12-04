<?php
/**
 * Custom Scrollbar
 *
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015-2016 Michael Uno
 *
 */

/**
 * Handles loading resources.
 *
 * @since       1.3.0
 */
class CustomScrollbar_ResourceLoader extends CustomScrollbar_PluginUtility {

    /**
     * Sets up properties and hooks
     */
    public function __construct() {

        if ( ! $this->___shouldProceed() ) {
            return;
        }

        $_aScrollbars   = $this->___getScrollbars();
        new CustomScrollbar_ResourceLoader__Script( $_aScrollbars );
        new CustomScrollbar_ResourceLoader__Style( $_aScrollbars );

    }
        /**
         * @return      boolean
         * @since       1.3.0
         */
        private function ___shouldProceed() {
            if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
                return false;
            }
            if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
                return false;
            }
            return true;
        }
        /**
         * @return      array
         * @since       1.3.0
         */
        private function ___getScrollbars() {

            $_oOption     = CustomScrollbar_Option::getInstance();
            $_aScrollbars = $this->getAsArray( $_oOption->get( 'scrollbars' ) );
            $_aScrollbars = $this->___getActivatedScrollbars( $_aScrollbars );
            if ( ! count( $_aScrollbars ) ) {
                return array();
            }
            /**
             * Let third-parties modify processing scrollbar options.
             * If somebody wants to add more advanced options, use this filter hook.
             * @since       1.3.0
             */
            $_aScrollbars = apply_filters(
                CustomScrollbar_Registry::HOOK_SLUG . '_filter_activated_scrollbars',
                $_aScrollbars
            );
            return $_aScrollbars;

        }
            /**
             * @remark      Drops items with the Off status.
             * @return      array
             */
            private function ___getActivatedScrollbars( array $aScrollbars ) {
                $_aDefault = $this->getElementAsArray(
                    CustomScrollbar_Registry::$aOptions,
                    array( 'custom-scrollbar.php', 'scrollbars', 0 )
                );
                foreach( $aScrollbars as $_iIndex => &$_aScrollbar ) {
                    $_aScrollbar = $_aScrollbar + $_aDefault;
                    if ( ! $_aScrollbar[ 'status' ] ) {
                        unset( $aScrollbars[ $_iIndex ] );
                    }
                }
                return $aScrollbars;
            }

}