<?php

namespace RandData;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-23 at 12:34:08.
 */
class CsvReaderTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var CsvReader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new CsvReader;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\CsvReader::get
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage File is not readable
     */
    public function testGetException() {
        $this->object->get("nonexistantfile.txt");
    }
    
    /**
     * @covers RandData\CsvReader::get
     */
    public function testGet() {
        $expected = [
            "one",
            "two",
            "three",
            "four",
            "five",
            "six"
        ];
        $this->assertEquals($expected, $this->object->get(__DIR__ . "/csvtest.csv"));
    }
}
