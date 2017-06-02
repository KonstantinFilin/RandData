<?php

namespace RandData\Set\ru_RU;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-06-02 at 18:52:50.
 */
class PersonTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Person
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Person;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getSex
     * @covers RandData\Set\ru_RU\Person::setSex
     */
    public function testGetSex() {
        $this->assertNull($this->object->getSex());
        $this->object->setSex(Person::SEX_MALE);
        $this->assertEquals(Person::SEX_MALE, $this->object->getSex());
    }

    /**
     * @covers RandData\Set\ru_RU\Person::get
     */
    public function testGet() 
    {
        $value = $this->object->get();
        $this->assertNotEmpty($value);
        $this->assertTrue(mb_substr_count($value, " ") == 2);
    }

    /**
     * @covers RandData\Set\ru_RU\Person::init
     */
    public function testInit() {
        $sex1 = Person::SEX_FEMALE;
        $sex2 = Person::SEX_MALE;
        $format1 = "abc";
        $format2 = "def";
        
        $params1 = [
            "sex" => $sex1,
            "format" => $format1
        ];
        
        $params2 = [
            "sex" => $sex2,
            "format" => $format2
        ];
        
        $this->object->init($params1);
        $this->assertEquals($sex1, $this->object->getSex());
        $this->assertEquals($format1, $this->object->getFormat());
        
        $this->object->init($params2);
        $this->assertEquals($sex2, $this->object->getSex());
        $this->assertEquals($format2, $this->object->getFormat());
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getLastName
     */
    public function testGetLastName() 
    {
        $val = $this->object->getLastName(Person::SEX_MALE);
        $this->assertNotEmpty($val);
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getFirstName
     */
    public function testGetFirstName() {
        $val = $this->object->getFirstName(Person::SEX_MALE);
        $this->assertNotEmpty($val);
    }
    
    /**
     * @covers RandData\Set\ru_RU\Person::getFormat
     * @covers RandData\Set\ru_RU\Person::setFormat
     */
    public function testGetFormat()
    {
        $this->assertEquals("l f m", $this->object->getFormat());
        $value = "abc";
        $this->object->setFormat($value);
        $this->assertEquals($value, $this->object->getFormat());
    }
    
    /**
     * @covers RandData\Set\ru_RU\Person::getMiddleName
     */
    public function testGetMiddleName() {
        $val = $this->object->getMiddleName(Person::SEX_MALE);
        $this->assertNotEmpty($val);
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getLastNameFemale
     */
    public function testGetLastNameFemale() {
        $value = $this->object->getLastNameFemale();
        $this->assertNotEmpty($value);
        $this->assertTrue(is_array($value));
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getFirstNameFemale
     */
    public function testGetFirstNameFemale() {
        $value = $this->object->getFirstNameFemale();
        $this->assertNotEmpty($value);
        $this->assertTrue(is_array($value));
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getFirstNameMale
     */
    public function testGetFirstNameMale() {
        $value = $this->object->getFirstNameMale();
        $this->assertNotEmpty($value);
        $this->assertTrue(is_array($value));
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getMiddleNameFemale
     */
    public function testGetMiddleNameFemale() {
        $value = $this->object->getMiddleNameFemale();
        $this->assertNotEmpty($value);
        $this->assertTrue(is_array($value));
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getMiddleNameMale
     */
    public function testGetMiddleNameMale() {
        $value = $this->object->getMiddleNameMale();
        $this->assertNotEmpty($value);
        $this->assertTrue(is_array($value));
    }

    /**
     * @covers RandData\Set\ru_RU\Person::getLastNameMale
     */
    public function testGetLastNameMale() {
        $value = $this->object->getLastNameMale();
        $this->assertNotEmpty($value);
        $this->assertTrue(is_array($value));
    }
}
