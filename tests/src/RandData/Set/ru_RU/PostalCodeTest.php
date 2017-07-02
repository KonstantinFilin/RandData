<?php

namespace RandData\Set\ru_RU;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-25 at 23:55:12.
 */
class PostalCodeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PostalCode
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new PostalCode;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\ru_RU\PostalCode::get
     */
    public function testGet() {
        $res = $this->object->get();
        $this->assertNotEmpty($res);
        $this->assertTrue(strlen($res) == 6);
        $this->assertRegExp("/^[\d]{6}$/", $res);
    }
}