<?php

namespace RandData\Generator;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-05 at 14:47:40.
 */
class JsonTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \RandData\Formatter\Json
     */
    protected $formatter;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->formatter = new \RandData\Formatter\Json();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Formatter\Json::build
     */
    public function testBuild() {
        $headers = [ "f1", "f2", "f3", "f4" ];
        $data1 = [ "aaa", "bbb", "ccc", "ddd" ];
        $data2 = [ "ee", "ff", "gg", "hh" ];
        $data = [ 
            array_combine($headers, $data1), 
            array_combine($headers, $data2) 
        ];

        
        $this->formatter->setHeaders($headers);
        $this->assertEquals(json_encode($data, JSON_PRETTY_PRINT), $this->formatter->build($data));        
    }

    /**
     * @covers RandData\Formatter\Json::buildOne
     */
    public function testBuildOne() {
        $headers = [ "f1", "f2", "f3", "f4" ];
        $data1 = [ "aaa", "bbb", "ccc", "ddd" ];
        $data2 = [ "ee", "ff", "gg", "hh" ];
        
        $this->formatter->setHeaders($headers);
        $this->assertEquals(array_combine($headers, $data1), $this->formatter->buildOne(4, $data1));
    }
}
