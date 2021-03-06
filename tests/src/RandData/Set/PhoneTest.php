<?php

namespace RandData\Set;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-02 at 15:41:16.
 */
class PhoneTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Phone
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Phone;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\Phone::__construct
     * @covers RandData\Set\Phone::get
     * @covers RandData\Set\Phone::getStart
     * @covers RandData\Set\Phone::getFinish
     */
    public function testGet() {
        for ($i = 1; $i <= 10; $i++) {
            $value = $this->object->get();
            $this->assertRegExp("/^\+\d \([\d]{3}\) [\d]{3}-[\d]{2}-[\d]{2}$/", $value);
        }
        
        $this->object->setRegionList([ "1234", "5678", "9090" ]);
        
        for ($i = 1; $i <= 10; $i++) {
            $value = $this->object->get();
            $this->assertRegExp("/^\+\d \([\d]{4}\) [\d]{3}-[\d]{3}$/", $value);
        }
        
        $this->object->setFormat(false);
        for ($i = 1; $i <= 10; $i++) {
            $value = $this->object->get();
            $this->assertRegExp("/^[\d]{11}$/", $value);
        }
    }

    /**
     * @covers RandData\Set\Phone::init
     * @covers RandData\Set\Phone::setCountryList
     * @covers RandData\Set\Phone::setRegionList
     */
    public function testInit() 
    {
        $countryList1 = [ 2, 4, 7 ];
        $countryList2 = [ 3, 8 ];
        $countryList3 = 7;
        $regionList1 = [ "123", "456", "7890" ];
        $regionList2 = [ "321", "0987" ];
        $regionList3 = "321";
        
        $format1 = false;
        $format2 = true;
        
        $params1 = [
            "country_list" => $countryList1,
            "region_list" => $regionList1,
            "format" => $format1
        ];
        
        $this->object->init($params1);
        
        $this->assertEquals($countryList1, $this->object->getCountryList());
        $this->assertEquals($regionList1, $this->object->getRegionList());
        $this->assertEquals($format1, $this->object->getFormat());
        
        $params2 = [
            "country_list" => $countryList2,
            "region_list" => $regionList2,
            "format" => $format2
        ];
        
        $this->object->init($params2);
        
        $this->assertEquals($countryList2, $this->object->getCountryList());
        $this->assertEquals($regionList2, $this->object->getRegionList());
        $this->assertEquals($format2, $this->object->getFormat());
        
        $params3 = [
            "country_list" => $countryList3,
            "region_list" => $regionList3
        ];
        
        $this->object->init($params3);
        
        $this->assertEquals([ $countryList3 ], $this->object->getCountryList());
        $this->assertEquals([ $regionList3 ], $this->object->getRegionList());
    }

    /**
     * @covers RandData\Set\Phone::getCountryList
     */
    public function testGetCountryList() 
    {
        $default = [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ];
        $this->assertEquals($default, $this->object->getCountryList());
        
        $param1 = [
            "1", "2", "5"
        ];
        $this->object->setCountryList($param1);
        $this->assertEquals($param1, $this->object->getCountryList());
    }

    /**
     * @covers RandData\Set\Phone::getRegionList
     * @covers RandData\Set\Phone::setRegionList
     */
    public function testGetRegionList() 
    {
        $default = [
            "123", "456", "789", 
            "111", "222", "333", 
            "444", "555", "666", 
            "777", "888", "999"            
        ];
        $this->assertEquals($default, $this->object->getRegionList());
        
        $param1 = [
            "123", "456", "7890"
        ];
        $this->object->setRegionList($param1);
        $this->assertEquals($param1, $this->object->getRegionList());
    }

    /**
     * @covers RandData\Set\Phone::getFormat
     * @covers RandData\Set\Phone::setFormat
     */
    public function testGetFormat() 
    {
        $this->assertTrue($this->object->getFormat());
        $this->object->setFormat(false);
        $this->assertFalse($this->object->getFormat());
        $this->object->setFormat(true);
        $this->assertTrue($this->object->getFormat());

    }
}
