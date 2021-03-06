<?php

namespace RandData\Set;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-06 at 16:33:29.
 */
class EmailTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Email
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Email;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\Email::__construct
     * @covers RandData\Set\Email::getDomainList
     * @covers RandData\Set\Email::setDomainList
     */
    public function testGetDomainList() 
    {
        $vals = [ "host1.com", "host2.com" ];
        $this->assertEmpty($this->object->getDomainList());
        $this->object->setDomainList($vals);
        $this->assertEquals($vals, $this->object->getDomainList());
    }

    /**
     * @covers RandData\Set\Email::get
     */
    public function testGet() {
        $regexp = "/^[abcdefghijklmnopqrstunwxyz0123456789]+@[abcdefghijklmnoprstuvwxyz0123456789-]+\.[\w]{2,4}$/";
        
        for ($i = 1; $i <= 10; $i++) {
            $result = $this->object->get();
            $this->assertNotEmpty($result);
            $this->assertRegExp($regexp, $result);
        }
    }

    /**
     * @covers RandData\Set\Email::get
     * @covers RandData\Set\Email::init
     */
    public function testInit() {
        $domainList = [ "abc.com", "def.edu", "ghi.org" ];
        $params = [
            "domain_list" => $domainList
        ];
        
        $this->assertNotEquals($domainList, $this->object->getDomainList());
        $this->object->init($params);
        $this->assertEquals($domainList, $this->object->getDomainList());
        $res = $this->object->get();
        $this->assertNotEmpty($res);
        $this->assertRegExp("/(abc\.com|def\.edu|ghi\.org)$/", $res);
    }
}
