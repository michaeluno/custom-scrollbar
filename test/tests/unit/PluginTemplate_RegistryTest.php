<?php

/*
 $this->assertEquals()
$this->assertContains()
$this->assertFalse()
$this->assertTrue()
$this->assertNull()
$this->assertEmpty()
*/

class PluginTemplate_RegistryTest extends \Codeception\Test\Unit {

    public function testGetPluginURL() {

    }

    public function testSetAdminNotice() {

    }

//    public function testSetUp() {
//
//        PluginTemplate_Registry::$sDirPath = '';
//
//        PluginTemplate_Registry::setUp();
//        $this->assertEquals(
//            dirname( PluginTemplate_Registry::$sFilePath ),
//            PluginTemplate_Registry::$sDirPath
//        );
//
//    }

    public function testReplyToShowAdminNotices() {

    }

    public function testRegisterClasses() {

//        $_aClassFiles = $this->getStaticAttribute( 'PluginTemplate_Registry', '___aAutoLoadClasses' );
//        PluginTemplate_Registry::registerClasses( $_aClassFiles );
//        $this->assertAttributeEquals( $_aClassFiles , '___aAutoLoadClasses', 'PluginTemplate_Registry' );
//
//        $_aClassFiles = array( 'SomeClass' => 'SomeClass.php' );
//        PluginTemplate_Registry::registerClasses( $_aClassFiles );
//        $this->assertAttributeNotEquals(
//            $_aClassFiles ,
//            '___aAutoLoadClasses',
//            'PluginTemplate_Registry'
//        );
//
//        $this->assertArrayHasKey(
//            'SomeClass',
//            $this->getStaticAttribute( 'PluginTemplate_Registry', '___aAutoLoadClasses' ),
//            'The key just set does not exist.'
//        );

    }

    public function testReplyToLoadClass() {

//        $this->assertFalse(
//            class_exists( 'JustAClass' ),
//            'The JustAClass class must not exist at this stage.'
//        );
//        include( codecept_root_dir() . '/tests/include/class-list.php' );
//        PluginTemplate_Registry::registerClasses( $_aClassFiles );
//        $this->assertTrue(
//            class_exists( 'JustAClass' ),
//            'The class auto load failed with the PluginTemplate_Registry::registerClasses() method.'
//        );

    }

}
