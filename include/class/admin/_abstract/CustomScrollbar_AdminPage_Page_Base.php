<?php
/**
 * Custom Scrollbar
 * 
 * http://en.michaeluno.jp/amazon-auto-inks/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 */

/**
 * Provides an abstract base for adding pages.
 * 
 * @since        1
 */
abstract class CustomScrollbar_AdminPage_Page_Base extends CustomScrollbar_AdminPage_RootBase {

    /**
     * Stores the factory object.
     */
    public $oFactory;

    /**
     * Stores the associated page slug with the adding section.
     */
    public $sPageSlug;    

    /**
     * Sets up hooks and properties.
     */
    public function __construct( $oFactory, array $aPageArguments ) {
        
        $this->oFactory     = $oFactory;
        $this->sPageSlug    = $aPageArguments['page_slug'];
        $this->_addPage( $aPageArguments );
        $this->construct( $oFactory );
        $this->_enqueueStyle();
        
    }
        /**
         * Enqueues the style of the css file with the page slug name to the page.
         */
        protected function _enqueueStyle() {
            $this->oFactory->enqueueStyle( 
                CustomScrollbar_Registry::getPluginURL( 'asset/css/' . $this->sPageSlug . '.css' ),
                $this->sPageSlug
            );    
        }    
    
    private function _addPage( array $aPageArguments ) {
        
        $this->oFactory->addSubMenuItems(
            $aPageArguments
            + array(
                'page_slug'     => null,
                'title'         => null,
                'screen_icon'   => null,
            )                
        );
        add_action( "load_{$this->sPageSlug}", array( $this, 'replyToLoadPage' ) );
        add_action( "do_{$this->sPageSlug}", array( $this, 'replyToDoPage' ) );
        add_action( "do_after_{$this->sPageSlug}", array( $this, 'replyToDoAfterPage' ) );
        add_filter( "validation_{$this->sPageSlug}", array( $this, 'validate' ), 10, 4 );
        
    }

    /**
     * Called when the page loads.
     * 
     * @remark      This method should be overridden in each extended class.
     */
    // public function replyToLoadPage( $oFactory ) {}
    // public function replyToDoPage( $oFactory ) {}
    // public function replyToDoAfterPage( $oFactory ) {}
    // public function validate( $aInput, $aOldInput, $oFactory, $aSubmitInfo ){}
    
}