<?php

namespace RandData\Set;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-05-26 at 19:04:22.
 */
class StringTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var String
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new String;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\String::getLengthMin
     * @covers RandData\Set\String::setLengthMin
     * @covers RandData\Set\String::getLengthMax
     * @covers RandData\Set\String::setLengthMax
     */
    public function testGetLength() {
        $this->assertEquals(1, $this->object->getLengthMin());
        $this->assertEquals(10, $this->object->getLengthMax());
        $val1 = 4;
        $val2 = 20;
        $this->object->setLengthMin($val1);
        $this->object->setLengthMax($val2);
        $this->assertEquals($val1, $this->object->getLengthMin());
        $this->assertEquals($val2, $this->object->getLengthMax());
        $this->object->setLengthMax(0);
        $this->assertEquals(String::LENGTH_MAX_MAX, $this->object->getLengthMax());
    }

    /**
     * @covers RandData\Set\String::getChars
     * @covers RandData\Set\String::setChars
     */
    public function testGetChars() {
        $this->assertEquals(
            String::CHARS_LAT_U . String::CHARS_LAT_L . String::CHARS_DIGITS, 
            $this->object->getChars()
        );
        $val1 = "abcde";
        $this->object->setChars($val1);
        $this->assertEquals(
            $val1, 
            $this->object->getChars()
        );
    }

    /**
     * @covers RandData\Set\String::addChars
     * @covers RandData\Set\String::setChars
     */
    public function testAddChars() {
        $val1 = "abcd";
        $val2 = "ef";
        $this->object->setChars($val1);
        $this->assertEquals(
            $val1, 
            $this->object->getChars()
        );
        
        $this->object->addChars($val2);
        $this->assertEquals($val1 . $val2, $this->object->getChars());
    }


    /**
     * @covers RandData\Set\String::__construct
     * @covers RandData\Set\String::get
     * @covers RandData\Set\String::generateLength
     */
    public function testGet() {
        $minLen = 5;
        $maxLen = 7;
        $obj = new String($maxLen, $minLen);
        
        foreach ( [ "abc", "7890", "+-*/=" ] as $charList ) {
            $obj->setChars($charList);

            for ($i = 1; $i <= 10; $i++) {
                $res = $obj->get();
                $len = mb_strlen($res);
                
                for ($j = 0; $j <= $len-1; $j++) {
                    $this->assertContains($res[$j], $charList);
                    $this->assertTrue($len >= $minLen);
                    $this->assertTrue($len <= $maxLen);
                }
            }            
        }
    }

    /**
     * @covers RandData\Set\String::init
     */
    public function testInit() {
        $lenMin1 = 7;
        $lenMax1 = 12;
        $lenMin2 = 5;
        $lenMax2 = 9;
        $charList1 = "abcdefghi";
        $charList2 = "xyzfs";
        
        $params1 = [
            "length_min" => $lenMin1,
            "length_max" => $lenMax1,
            "char_list" => $charList1
        ];
        
        $params2 = [
            "length_min" => $lenMin2,
            "length_max" => $lenMax2,
            "char_list" => $charList2
        ];
        
        $this->object->init($params1);
        $this->assertEquals($lenMin1, $this->object->getLengthMin());
        $this->assertEquals($lenMax1, $this->object->getLengthMax());
        $this->assertEquals($charList1, $this->object->getChars());

        $this->object->init($params2);
        $this->assertEquals($lenMin2, $this->object->getLengthMin());
        $this->assertEquals($lenMax2, $this->object->getLengthMax());
        $this->assertEquals($charList2, $this->object->getChars());
    }
}
