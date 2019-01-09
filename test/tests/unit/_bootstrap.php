<?php
$GLOBALS[ '_sProjectDirPath' ]    = dirname( codecept_root_dir() );
$GLOBALS[ '_sTestSiteDirPath' ]   = dirname( dirname( dirname( $GLOBALS['_sProjectDirPath'] ) ) );

// ABSPATH is needed to load the framework.
define( 'ABSPATH', $GLOBALS[ '_sTestSiteDirPath' ]. '/' );


codecept_debug( 'Unit: _bootstrap.php loaded' );
var_dump( 'unit bootstrap' );

define( 'DOING_TESTS', true );

// Paths
$_sPluginRootDirPath = dirname( codecept_root_dir() );
$_aFiles = array(
    $_sPluginRootDirPath . '/plugin-template.php',
    $_sPluginRootDirPath . '/include/class-list.php'
);
foreach ( $_aFiles as $_sPath ) {
    if ( ! file_exists( $_sPath ) ) {
        continue;
    }
    include( $_sPath );
}
if ( class_exists( 'PluginTemplate_Registry' ) ) {
    PluginTemplate_Registry::registerClasses( $_aClassFiles );
}
