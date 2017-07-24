<?php

namespace RandData\Fabric\DataSet;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-23 at 21:19:33.
 */
class StringNumericTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var StringNumeric
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new StringNumeric;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Fabric\DataSet\StringNumeric::create
     */
    public function testCreate1() {
        $setInfo = new \RandData\SetInfo("integer");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Integer::class, get_class($actual));
    }

    /**
     * @covers RandData\Fabric\DataSet\StringNumeric::create
     */
    public function testCreate2() {
        $setInfo = new \RandData\SetInfo("int");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Integer::class, get_class($actual));
    }

    /**
     * @covers RandData\Fabric\DataSet\StringNumeric::create
     */
    public function testCreate3() {
        $setInfo = new \RandData\SetInfo("decimal");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Decimal::class, get_class($actual));
    }

    /**
     * @covers RandData\Fabric\DataSet\StringNumeric::create
     */
    public function testCreate4() {
        $setInfo = new \RandData\SetInfo("boolean");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Boolean::class, get_class($actual));
    }
    
    /**
     * @covers RandData\Fabric\DataSet\StringNumeric::create
     */
    public function testCreateNull() {
        $setInfo = new \RandData\SetInfo("abc");
        $actual = $this->object->create($setInfo);
        
        $this->assertNull($actual);
    }

}
