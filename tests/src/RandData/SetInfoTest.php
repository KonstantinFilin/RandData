<?php

namespace RandData;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-05-25 at 10:09:12.
 */
class SetInfoTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SetInfo
     */
    protected $object;
    protected $nameDefault;
    protected $paramsDefault;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->nameDefault = "xyz";
        $this->paramsDefault = [ "key1" => "value1", "key2" => "value2" ];
        $this->object = new SetInfo($this->nameDefault, $this->paramsDefault);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\SetInfo::getName
     * @covers RandData\SetInfo::setName
     */
    public function testGetName() {
        $this->assertEquals($this->nameDefault, $this->object->getName());        
        $name1 = "abc";
        $this->object->setName($name1);
        $this->assertEquals($name1, $this->object->getName());
        $name2 = "def";
        $this->object->setName($name2);
        $this->assertEquals($name2, $this->object->getName());
    }

    /**
     * @covers RandData\SetInfo::getParams
     * @covers RandData\SetInfo::setParams
     */
    public function testGetParams() {
        $this->assertEquals($this->paramsDefault, $this->object->getParams());
        
        $params1 = [];
        $this->object->setParams($params1);
        $this->assertEquals($params1, $this->object->getParams());
        
        $params2 = [ "keyA" => "valueA", "keyB" => "valueB", "keyC" => "valueC" ];
        $this->object->setParams($params2);
        $this->assertEquals($params2, $this->object->getParams());
    }
}
