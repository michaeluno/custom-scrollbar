<?php
/**
 * Custom Scrollbar
 *
 * http://en.michaeluno.jp/custom-scrollbar/
 * Copyright (c) 2015-2016 Michael Uno
 *
 */

/**
 * Loads scripts.
 *
 * @since       1.3.0
 */
class CustomScrollbar_ResourceLoader__Style extends CustomScrollbar_PluginUtility {

    private $___aScrollbars = array();

    /**
     * Sets up properties and hooks
     */
    public function __construct( array $aScrollbars ) {

        $this->___aScrollbars = $aScrollbars;
        add_action( 'wp_print_styles', array( $this, 'replyToLoad' ) );

    }

    /**
     * @callback    action      wp_print_styles
     * @return void
     */
    public function replyToLoad() {

        $_oOption    = CustomScrollbar_Option::getInstance();
        $_sCSSRules  = $_oOption->get( 'css', 'custom_css' );
        $_sCSSRules .= $this->___getScrollbarCSSRules( $this->___aScrollbars );
        $_sCSSRules  = trim( $_sCSSRules );
        if ( ! $_sCSSRules ) {
            return;
        }
        $this->___printCSSRules( $_sCSSRules );

    }

        /**
         * @return      string
         */
        private function ___getScrollbarCSSRules( array $aScrollbars ) {

            $_sDelimiter = $this->isDebugMode()
                ? PHP_EOL
                : ' ';
            $_aCSS       = array();
            foreach( $aScrollbars as $_aScrollbar ) {

                $_aScrollbar[ 'selector' ] = trim( $_aScrollbar[ 'selector' ] );
                if ( ! $_aScrollbar[ 'selector' ] ) {
                    continue;
                }

                // Start
                $_aEach    = array();
                $_aCSSEach = array(
                    "{$_aScrollbar[ 'selector' ]} {"
                );

                // y (height)
                if ( $_aScrollbar[ 'height' ][ 'size' ] ) {
                    $_aEach[] = "max-height: {$_aScrollbar[ 'height' ][ 'size' ]}{$_aScrollbar[ 'height' ][ 'unit' ]};";
                    $_aEach[] = "overflow-y: auto;";
                } else {
                    $_aEach[] = "overflow-y: hidden;";
                }

                // x (width)
                if ( $_aScrollbar[ 'width' ][ 'size' ] ) {
                    $_aEach[] = "max-width: {$_aScrollbar[ 'width' ][ 'size' ]}{$_aScrollbar[ 'width' ][ 'unit' ]};";
                    $_aEach[] = "white-space: pre-wrap;";
                    $_aEach[] = "overflow-x: auto;";
                } else {
                    $_aEach[] = "overflow-x: hidden;";
                }

                // End
                $_aCSSEach[] = implode( $_sDelimiter, $_aEach ) . "}";
                $_aCSS[]     = implode( $_sDelimiter, $_aCSSEach );

            }
            return $_sDelimiter . implode( $_sDelimiter, $_aCSS );

        }

        /**
         * @callback    action      wp_head
         * @return      void
         * @since       1.3.0
         */
        private function ___printCSSRules( $sCSSRules ) {
            $sCSSRules = $this->isDebugMode()
                ? $sCSSRules
                : $this->getCSSMinified( $sCSSRules );
            echo "<style class='custom-scrollbar' type='text/css'>"
                    . $sCSSRules
                 . "</style>";
        }

}