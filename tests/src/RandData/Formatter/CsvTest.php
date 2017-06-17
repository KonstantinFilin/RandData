<?php

namespace RandData\Formatter;

class TupleImplementationCsv extends \RandData\Tuple
{
    public function getDataSets() {
        return [
            "f1" => "integer:min=1;max=100",
            "f2" => "integer:min=1;max=100",
            "f3" => "integer:min=1;max=100",
            "f4" => "integer:min=1;max=100"
        ];
    }
}

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-04 at 13:03:57.
 */
class CsvTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \RandData\Formatter\Csv
     */
    protected $formatter;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->formatter = new \RandData\Formatter\Csv(new \RandData\Generator(new TupleImplementationCsv()));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Formatter\Csv::build
     * @covers RandData\Formatter\Csv::buildOne
     * @covers RandData\Formatter\Csv::setShowCounter
     */
    public function testShowCounter() 
    {
        $columnDelim = ";";
        $data1 = [ "f1" => "aaa", "f2" => "bbb", "f3" => "ccc", "f4" => "ddd" ];
        $data2 = [ "f1" => "ee", "f2" => "ff", "f3" => "gg", "f4" => "hh" ];

        $generator = $this->createMock(\RandData\Generator::class);
        $generator->method("getTuple")->willReturn(new TupleImplementationCsv());
        $generator->method("run")->willReturn([ $data1, $data2 ]);
        $formatter = new \RandData\Formatter\Csv($generator);
        $formatter->setShowCounter(true);
        $formatter->setShowHeaders(true);
        
        $expected2 = "#;f1;f2;f3;f4" . PHP_EOL . "1" . $columnDelim . implode($columnDelim, $data1) . PHP_EOL . "2" . $columnDelim . implode($columnDelim, $data2);
        $this->assertEquals($expected2, $formatter->build());
        
        $formatter->setShowCounter(false);
        $expected4 = "f1;f2;f3;f4" . PHP_EOL . implode($columnDelim, $data1) . PHP_EOL . implode($columnDelim, $data2);
        $this->assertEquals($expected4, $formatter->build());
    }

    /**
     * @covers RandData\Formatter\Csv::build
     * @covers RandData\Formatter\Csv::setShowHeaders
     */
    public function testShowHeaders() 
    {
        $columnDelim = ";";
        $data1 = [ "aaa", "bbb", "ccc", "ddd" ];
        $data2 = [ "ee", "ff", "gg", "hh" ];
        $data = [ 
            implode($columnDelim, $data1),
            implode($columnDelim, $data2)
        ];
        
        $generator = $this->createMock(\RandData\Generator::class);
        $generator->method("getTuple")->willReturn(new TupleImplementationCsv());
        $generator->method("run")->willReturn([ $data1, $data2 ]);
        $formatter = new \RandData\Formatter\Csv($generator);

        $expected1 = "#;f1;f2;f3;f4" . PHP_EOL . "1" . $columnDelim . implode($columnDelim, $data1) . PHP_EOL . "2" . $columnDelim . implode($columnDelim, $data2);
        $this->assertEquals($expected1, $formatter->build());
        
        $formatter->setShowHeaders(false);
        
        $expected2 = "1" . $columnDelim . implode($columnDelim, $data1) . PHP_EOL . "2" . $columnDelim . implode($columnDelim, $data2);
        $this->assertEquals($expected2, $formatter->build());
    }

    /**
     * @covers RandData\Formatter\Csv::build
     * @covers RandData\Formatter\Csv::setColumnDelim
     * @covers RandData\Formatter\Csv::setLineDelim
     */
    public function testSetColumnDelim() 
    {
        $columnDelim = ";";
        $columnDelim2 = ":";
        $lineDelim = "**";
        
        $data1 = [ "aaa", "bbb", "ccc", "ddd" ];
        $data2 = [ "ee", "ff", "gg", "hh" ];
        $data = [ 
            implode($columnDelim, $data1), 
            implode($columnDelim, $data2) 
        ];
        
        $generator = $this->createMock(\RandData\Generator::class);
        $generator->method("getTuple")->willReturn(new TupleImplementationCsv());
        $generator->method("run")->willReturn([ $data1, $data2 ]);
        $formatter = new \RandData\Formatter\Csv($generator);
        
        $expected1 = "#;f1;f2;f3;f4" . PHP_EOL . "1" . $columnDelim . implode($columnDelim, $data1) . PHP_EOL . "2" . $columnDelim . implode($columnDelim, $data2);
        $this->assertEquals($expected1, $formatter->build());
        
        $formatter->setColumnDelim($columnDelim2);
        $formatter->setLineDelim($lineDelim);
        $formatter->setLineDelim($lineDelim);
        
        $expected2 = "#:f1:f2:f3:f4" . $lineDelim . "1" . $columnDelim2 . implode($columnDelim2, $data1) . $lineDelim . "2" . $columnDelim2 . implode($columnDelim2, $data2);
        $this->assertEquals($expected2, $formatter->build());
    }
}