<?php

namespace RandData\Fabric\DataSet;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-23 at 21:37:46.
 */
class StringTextTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var StringText
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new StringText;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Fabric\DataSet\StringText::create
     */
    public function testCreateNull() {
        $setInfo = new \RandData\SetInfo("abc");
        $actual = $this->object->create($setInfo);
        
        $this->assertNull($actual);
    }
    
    /**
     * @covers RandData\Fabric\DataSet\StringText::create
     */
    public function testCreate1() {
        $setInfo = new \RandData\SetInfo("string_list");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\StringList::class, get_class($actual));
    }
    
    /**
     * @covers RandData\Fabric\DataSet\StringText::create
     */
    public function testCreate2() {
        $setInfo = new \RandData\SetInfo("string");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\String::class, get_class($actual));
    }
    
    /**
     * @covers RandData\Fabric\DataSet\StringText::create
     */
    public function testCreate3() {
        $setInfo = new \RandData\SetInfo("paragraph");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Paragraph::class, get_class($actual));
    }
}