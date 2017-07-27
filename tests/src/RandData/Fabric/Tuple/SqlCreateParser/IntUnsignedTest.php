<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-24 at 11:46:41.
 */
class IntUnsignedTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var IntegerUnsigned
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new IntegerUnsigned;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Fabric\Tuple\SqlCreateParser\IntegerUnsigned::parse
     */
    public function testParse() {
        $fieldDefinition0 = "`report_day` tinyint(1) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("boolean:valTrue=1;valFalse=0", $this->object->parse($fieldDefinition0));
        $fieldDefinition1 = "`report_day` tinyint(3) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=255", $this->object->parse($fieldDefinition1));
        $fieldDefinition2 = "`report_day` tinyint(12) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=255", $this->object->parse($fieldDefinition2));
        $fieldDefinition3 = "`report_day` tinyint(123) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=255", $this->object->parse($fieldDefinition3));
        $fieldDefinition4 = "`report_day` smallint(1) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=65535", $this->object->parse($fieldDefinition4));
        $fieldDefinition5 = "`report_day` smallint(12) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=65535", $this->object->parse($fieldDefinition5));
        $fieldDefinition6 = "`report_day` smallint(123) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=65535", $this->object->parse($fieldDefinition6));
        $fieldDefinition7 = "`report_day` mediumint(123) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=16777215", $this->object->parse($fieldDefinition7));
        $fieldDefinition8 = "`report_day` mediumint(12) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=16777215", $this->object->parse($fieldDefinition8));
        $fieldDefinition9 = "`report_day` mediumint(1) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=16777215", $this->object->parse($fieldDefinition9));
        $fieldDefinition10 = "`report_day` int(9) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=" . mt_getrandmax(), $this->object->parse($fieldDefinition10));
        $fieldDefinition11 = "`report_day` bigint(9) unsigned NOT NULL DEFAULT '0'";
        $this->assertEquals("integer:min=0;max=" . mt_getrandmax(), $this->object->parse($fieldDefinition11));        $this->assertNull($this->object->parse("asdgasdg"));
    }
}
