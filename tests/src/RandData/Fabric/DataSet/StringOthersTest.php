<?php

namespace RandData\Fabric\DataSet;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-23 at 21:25:35.
 */
class StringOthersTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var StringOthers
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new StringOthers;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Fabric\DataSet\StringOthers::create
     */
    public function testCreate1() {
        $setInfo = new \RandData\SetInfo("phone");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Phone::class, get_class($actual));
    }

    /**
     * @covers RandData\Fabric\DataSet\StringOthers::create
     */
    public function testCreate2() {
        $setInfo = new \RandData\SetInfo("domain");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Domain::class, get_class($actual));
    }

    /**
     * @covers RandData\Fabric\DataSet\StringOthers::create
     */
    public function testCreate3() {
        $setInfo = new \RandData\SetInfo("email");
        $actual = $this->object->create($setInfo);
        
        $this->assertEquals(\RandData\Set\Email::class, get_class($actual));
    }

    /**
     * @covers RandData\Fabric\DataSet\StringOthers::create
     */
    public function testCreateNull() {
        $setInfo = new \RandData\SetInfo("abc");
        $actual = $this->object->create($setInfo);
        
        $this->assertNull($actual);
    }
}
