<?php

namespace RandData;

class TupleBLankImplementation extends Tuple
{
    public function getDataSets() 
    {
        return [
            "name" => "string_list:values=John,Paul,George,Ringo",
            "age" => "integer:min=19;max=30",
            "dt" => "date:min=1962-10-05;max=1970-05-08"
        ];
    }
}


/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-05 at 21:06:13.
 */
class BlankGeneratorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BlankGenerator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new BlankGenerator(new TupleBLankImplementation());
        $tpl = "Hello, I'm {name}, my age {age} and today is {dt}. Created at {dt} by {name}";
        $this->object->init($tpl);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\BlankGenerator::__construct
     * @covers RandData\BlankGenerator::run
     * @covers RandData\BlankGenerator::init
     * @covers RandData\BlankGenerator::setDelimStart
     * @covers RandData\BlankGenerator::getDelimStart
     * @covers RandData\BlankGenerator::setDelimFinish
     * @covers RandData\BlankGenerator::getDelimFinish
     */
    public function testRun() {
        $expected = "/^Hello, I'm ((John)|(Paul)|(George)|(Ringo)), my age [\d]{2} and today is ([\d]{4}-[\d]{2}-[\d]{2}). Created at \\6 by \\1$/";
        $this->assertRegExp($expected, $this->object->run());
        
        $delimStart = "[";
        $delimFinish = "]";
        $this->object->setDelimStart($delimStart);
        $this->object->setDelimFinish($delimFinish);
        
        $this->assertEquals($delimStart, $this->object->getDelimStart());
        $this->assertEquals($delimFinish, $this->object->getDelimFinish());
        
        // $this->object->init("Hello, I'm [name], my age [age] and today is [dt]. Created at [dt] by [name]");
        $expected2 = "/^Hello, I'm [name], my age [age] and today is [dt]. Created at [dt] by [name]$/";
        $this->assertNotRegExp($expected2, $this->object->run());
        
        $this->object->init("He will be [age] on the [dt]");
        $expected3 = "/^He will be [\d]{2} on the [\d]{4}-[\d]{2}-[\d]{2}$/";
        $this->assertRegExp($expected3, $this->object->run());
    }
}
