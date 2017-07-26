<?php

namespace RandData\Set\ru_RU;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-10 at 01:53:36.
 */
class CityTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var City
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new City;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\ru_RU\City::get
     * @covers RandData\Set\ru_RU\City::getList
     */
    public function testGet() {
        $pattern = "/^[АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя\w\s-]+$/";

        for ($i=1; $i <= 10; $i++) {
            $this->assertRegExp($pattern, $this->object->get());
        }
    }
}
