<?php

namespace RandData;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-05-25 at 10:09:12.
 */
class FabricTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Fabric
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new \RandData\Fabric\DataSet\String();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Fabric::create
     * @todo   Implement testCreateObjectFromString().
     */
    public function testCreateObjectFromString() {
        $this->assertInstanceOf(
            \RandData\Set\NullValue::class,
            $this->object->create(null)
        );
        
        $this->assertInstanceOf(
            \RandData\Set\Integer::class,
            $this->object->create("integer")
        );
    }

}
