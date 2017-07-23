<?php

namespace RandData;

class TupleImplementation1 extends \RandData\Tuple
{
    public function getDataSets() 
    {
        return [ "boolean", "integer:min=3;max=8", "time" ];
    }
}

class TupleImplementation2  extends \RandData\Tuple
{
    public function getDataSets() 
    {
        return [ 
            "field1" => "boolean", 
            "field2" => "integer:min=3;max=8", 
            "field3" => "time",
            "cnt" => "counter",
            "sub" => new TupleImplementation1()
        ];
    }
}

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-04 at 14:53:12.
 */
class GeneratorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Generator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Generator(new TupleImplementation1());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Generator::__construct
     * @covers RandData\Generator::getTuple
     */
    public function testTuple() {
        $obj = new Generator(new TupleImplementation1());
        $this->assertInstanceOf(TupleImplementation1::class, $obj->getTuple());
        $this->assertNotInstanceOf(TupleImplementation2::class, $obj->getTuple());
        $obj2 = new Generator(new TupleImplementation2());
        $this->assertInstanceOf(TupleImplementation2::class, $obj2->getTuple());
        $this->assertNotInstanceOf(TupleImplementation1::class, $obj2->getTuple());
    }

    /**
     * @covers RandData\Generator::getAmount
     * @covers RandData\Generator::setAmount
     */
    public function testSetAmount() {
        $this->assertEquals(10, $this->object->getAmount());
        $val = 5;
        $this->object->setAmount($val);
        $this->assertEquals($val, $this->object->getAmount());
    }

    /**
     * @covers RandData\Generator::run
     */
    public function testRun() {
        $result1 = $this->object->run();
        $this->assertNotEmpty($result1);
        $this->assertTrue(is_array($result1));
        $this->assertCount(10, $result1);
        
        $val = 7;
        $this->object->setAmount($val);
        $result2 = $this->object->run();
        $this->assertNotEmpty($result2);
        $this->assertTrue(is_array($result2));
        $this->assertCount($val, $result2);
        
        foreach ([ $result1, $result2 ] as $result) {
            foreach ($result as $row) {
                $this->assertTrue(is_array($row));
                $this->assertCount(3, $row);

                $this->assertRegExp("/^[NY]$/", $row[0]);
                $this->assertTrue(is_integer($row[1]));
                $this->assertTrue($row[1] >= 3 && $row[1] <= 8);
            }
        }        
    }
}
