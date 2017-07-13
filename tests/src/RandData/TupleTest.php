<?php

namespace RandData;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-04 at 12:27:04.
 */
class TupleTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Tuple
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new TupleImplementation1();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Tuple::get
     */
    public function testGet() 
    {
        $tuple2 = new TupleImplementation2();
        
        $randValArr = $tuple2->get();
        $this->assertNotEmpty($randValArr);
        $this->assertTrue(is_array($randValArr));
        $this->assertNotEmpty($randValArr["field1"]);
        $this->assertNotEmpty($randValArr["field2"]);
        $this->assertNotEmpty($randValArr["field3"]);
        
        $this->assertCount(3, $randValArr);
        $this->assertTrue(in_array($randValArr["field1"], [ "Y", "N" ]));
        $this->assertTrue(is_integer($randValArr["field2"]));
        $this->assertTrue($randValArr["field2"] >= 3 || $randValArr["field2"] <= 5);
        $this->assertTrue(is_string($randValArr["field3"]));
        $this->assertRegExp("/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/", $randValArr["field3"]);
    }

    /**
     * @covers RandData\Generator::getHeaders
     */
    public function testGetHeaders()
    {
        $obj1 = new TupleImplementation1();
        $expected1 = [ 1, 2, 3 ];
        $this->assertEquals($expected1, $obj1->getHeaders());
        
        $obj2 = new TupleImplementation2();
        $expected2 = [ "field1", "field2", "field3" ];
        $this->assertEquals($expected2, $obj2->getHeaders());
    }
}
