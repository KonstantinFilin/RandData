<?php

namespace RandData\Formatter;

class TupleImplementationSql extends \RandData\Tuple
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
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-13 at 21:20:10.
 */
class SqlTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Sql
     */
    protected $formatter;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $generator = new \RandData\Generator(new TupleImplementationSql());
        $this->formatter = new Sql($generator, "table1");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Formatter\Sql::__construct
     * @covers RandData\Formatter\Sql::build
     * @covers RandData\Formatter\Sql::buildOne
     * @covers RandData\Formatter\Sql::getPattern
     */
    public function testBuild() {
        $data = [ 
            [ "fld1" => "val11", "fld2" => "val12", "fld3" => "val13" ], 
            [ "fld1" => "val21", "fld2" => "val22", "fld3" => "val23" ], 
            [ "fld1" => "val31", "fld2" => "val32", "fld3" => "val33" ], 
        ];
        
        $generator = $this->createMock(\RandData\Generator::class);
        $generator->method("run")->willReturn($data);
        $formatter = new \RandData\Formatter\Sql($generator, "tblName");
        
        $expected = "INSERT INTO `tblName` (`fld1`,`fld2`,`fld3`) VALUES ('val11','val12','val13');
INSERT INTO `tblName` (`fld1`,`fld2`,`fld3`) VALUES ('val21','val22','val23');
INSERT INTO `tblName` (`fld1`,`fld2`,`fld3`) VALUES ('val31','val32','val33')";
        $this->assertEquals($expected, $formatter->build());
    }
}
