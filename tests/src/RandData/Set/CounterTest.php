<?php

namespace RandData\Set;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-15 at 11:01:52.
 */
class CounterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Counter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Counter;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\Counter::getTemplate
     * @covers RandData\Set\Counter::setTemplate
     */
    public function testGetTemplate() {
        $this->assertEquals("", $this->object->getTemplate());
        $value = "abc";
        $this->object->setTemplate($value);
        $this->assertEquals($value, $this->object->getTemplate());
                
    }

    /**
     * @covers RandData\Set\Counter::getStart
     * @covers RandData\Set\Counter::setStart
     */
    public function testGetStart() {
        $this->assertEquals(1, $this->object->getStart());
        $value = 7;
        $this->object->setStart($value);
        $this->assertEquals($value, $this->object->getStart());
                
    }

    /**
     * @covers RandData\Set\Counter::setStart
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid argument start: must be integer and between 1 and 1000000
     */
    public function testSetStart() {
        $this->object->setStart(0);
    }

    /**
     * @covers RandData\Set\Counter::setStart
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid argument start: must be integer and between 1 and 1000000
     */
    public function testSetStart2() {
        $this->object->setStart(1000001);
    }

    /**
     * @covers RandData\Set\Counter::__construct
     * @covers RandData\Set\Counter::get
     * @todo   Implement testGet().
     */
    public function testGet() {
        $cnt0 = 0;
        $cnt3 = 3;
        $cnt4 = 4;
        $tpl = "user_#";
        
        $this->assertEquals($cnt0, $this->object->get());
        $this->assertEquals($cnt3, $this->object->get($cnt3));
        $this->assertEquals($cnt4, $this->object->get($cnt4));
        
        $this->object->setTemplate($tpl);
        $this->assertEquals("user_3", $this->object->get($cnt3));
        $this->assertEquals("user_4", $this->object->get($cnt4));
        
        $this->object->setStart(11);
        $this->assertEquals("user_11", $this->object->get(1));
        $this->assertEquals("user_13", $this->object->get($cnt3));
        $this->assertEquals("user_14", $this->object->get($cnt4));
    }

    /**
     * @covers RandData\Set\Counter::init
     */
    public function testInit() {
        $this->assertEquals("", $this->object->getTemplate());
        $start = 9;
        $tpl = "user_#";
        $params = [ 
            "start" => $start,
            "template" => $tpl 
        ];
        $this->object->init($params);
        $this->assertEquals($start, $this->object->getStart());
        $this->assertEquals($tpl, $this->object->getTemplate());
    }

    /**
     * @covers RandData\Set\Counter::init
     */
    public function testInit2() {
        $this->assertEquals("", $this->object->getTemplate());
        $start = 9;
        $tpl = "user_#";
        $params = [ 
            "start" => $start,
            "tpl" => $tpl 
        ];
        $this->object->init($params);
        $this->assertEquals($start, $this->object->getStart());
        $this->assertEquals($tpl, $this->object->getTemplate());
    }
}
