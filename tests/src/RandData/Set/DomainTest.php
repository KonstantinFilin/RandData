<?php

namespace RandData\Set;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-06 at 15:45:15.
 */
class DomainTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Domain
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Domain;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\Domain::getTldList
     * @covers RandData\Set\Domain::setTldList
     */
    public function testGetTldList() {
        $val = "aaa,bbb,ccc";
        $this->assertEquals("com,edu,org,net", $this->object->getTldList());
        $this->object->setTldList($val);
        $this->assertEquals($val, $this->object->getTldList());
    }

    /**
     * @covers RandData\Set\Domain::getChars
     * @covers RandData\Set\Domain::setChars
     */
    public function testGetChars() 
    {
        $chars = "abcdef12345";
        $this->assertEquals("abcdefghijklmnoprstuvwxyz0123456789-", $this->object->getChars());
        $this->object->setChars($chars);
        $this->assertEquals($chars, $this->object->getChars());
    }

    /**
     * @covers RandData\Set\Domain::getCharsEdge
     * @covers RandData\Set\Domain::setCharsEdge
     */
    public function testGetCharsEdge() {
        $chars = "xyz7890";
        $this->assertEquals("abcdefghijklmnoprstuvwxyz0123456789", $this->object->getCharsEdge());
        $this->object->setCharsEdge($chars);
        $this->assertEquals($chars, $this->object->getCharsEdge());
    }

    /**
     * @covers RandData\Set\Domain::get
     */
    public function testGet() 
    {
        $this->object->setTldList("com,org,net");
        $this->object->setChars("abcdefg123");
        $this->object->setCharsEdge("abc");
        
        for ($i = 1; $i <= 10; $i++) {
            $result = $this->object->get();
            $this->assertNotEmpty($result);
            $this->assertRegExp("/^www\.[abc][abcdefg123]+[abc]\.((com)|(org)|(net))$/", $result);
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $this->object->skipWww();
            $result = $this->object->get();
            $this->assertNotEmpty($result);
            $this->assertRegExp("/^[abc][abcdefg123]+[abc]\.((com)|(org)|(net))$/", $result);
        }
    }

    /**
     * @covers RandData\Set\Domain::init
     */
    public function testInit() {
        $tldList = "a,b,c,d";
        $charList = "nop";
        $charListEdge = "a1z9";
        
        $this->object->init([
            "tld_list" => $tldList,
            "char_list" => $charList,
            "char_list_edge" => $charListEdge
        ]);
        
        $this->assertEquals($tldList, $this->object->getTldList());
        $this->assertEquals($charList, $this->object->getChars());
        $this->assertEquals($charListEdge, $this->object->getCharsEdge());
    }
}