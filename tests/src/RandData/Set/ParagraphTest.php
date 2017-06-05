<?php

namespace RandData\Set;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-05-29 at 13:14:11.
 */
class ParagraphTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Paragraph
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Paragraph;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers RandData\Set\Paragraph::getWordsMin
     * @covers RandData\Set\Paragraph::setWordsMin
     */
    public function testGetWordsMin() {
        $this->assertEquals(3, $this->object->getWordsMin());
        $val1 = 4;
        $this->object->setWordsMin($val1);
        $this->assertEquals($val1, $this->object->getWordsMin());
    }

    /**
     * @covers RandData\Set\Paragraph::getWordsMax
     * @covers RandData\Set\Paragraph::setWordsMax
     */
    public function testGetWordsMax() {
        $this->assertEquals(100, $this->object->getWordsMax());
        $val1 = 60;
        $this->object->setWordsMax($val1);
        $this->assertEquals($val1, $this->object->getWordsMax());
    }

    /**
     * @covers RandData\Set\Paragraph::get
     */
    public function testGet() {
        for ($i = 1; $i <= 10; $i++) {
            $paragraph = $this->object->get();
            $this->assertNotNull($paragraph);
            $this->assertNotEmpty($paragraph);
            $this->assertTrue(mb_strlen($paragraph) > 0);
        }
    }

    /**
     * @covers RandData\Set\Paragraph::init
     */
    public function testInit() {
        $lenMin1 = 7;
        $lenMax1 = 12;
        $lenMin2 = 5;
        $lenMax2 = 9;
        $charList1 = "abcdefghi";
        $charList2 = "xyzfs";
        $wordsAmountMin1 = 13;
        $wordsAmountMax1 = 19;
        $wordsAmountMin2 = 16;
        $wordsAmountMax2 = 23;
        
        $params1 = [
            "length_min" => $lenMin1,
            "length_max" => $lenMax1,
            "char_list" => $charList1,
            "words_min" => $wordsAmountMin1,
            "words_max" => $wordsAmountMax1
        ];
        
        $params2 = [
            "length_min" => $lenMin2,
            "length_max" => $lenMax2,
            "char_list" => $charList2,
            "words_min" => $wordsAmountMin2,
            "words_max" => $wordsAmountMax2
        ];
        
        $this->object->init($params1);
        $this->assertEquals($lenMin1, $this->object->getLengthMin());
        $this->assertEquals($lenMax1, $this->object->getLengthMax());
        $this->assertEquals($wordsAmountMin1, $this->object->getWordsMin());
        $this->assertEquals($wordsAmountMax1, $this->object->getWordsMax());
        $this->assertEquals($charList1, $this->object->getChars());

        $this->object->init($params2);
        $this->assertEquals($lenMin2, $this->object->getLengthMin());
        $this->assertEquals($lenMax2, $this->object->getLengthMax());
        $this->assertEquals($wordsAmountMin2, $this->object->getWordsMin());
        $this->assertEquals($wordsAmountMax2, $this->object->getWordsMax());
        $this->assertEquals($charList2, $this->object->getChars());
    }

}