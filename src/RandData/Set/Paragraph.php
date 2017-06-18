<?php

namespace RandData\Set;

/**
 * Random paragraph generator
 */
class Paragraph extends \RandData\Set\String
{
    /**
     * Minimum words amount
     * @var integer
     */
    protected $wordsMin;
    
    /**
     * Maximum words amount
     * @var integer
     */
    protected $wordsMax;

    /**
     * Class constructor
     * @param integer $wordsMin Minimum words amount
     * @param integer $wordsMax Maximum words amount
     */
    function __construct($wordsMin = 3, $wordsMax = 100) {
        parent::__construct();
        $this->wordsMin = $wordsMin;
        $this->wordsMax = $wordsMax;
        $this->setChars(self::CHARS_LAT_L);
    }

    /**
     * Returns minimum words amount
     * @return integer Minimum words amount
     */
    function getWordsMin() {
        return $this->wordsMin;
    }

    /**
     * Returns maximum words amount
     * @return integer Maximum words amount
     */
    function getWordsMax() {
        return $this->wordsMax;
    }

    /**
     * Sets minimum words amount
     * @param integer $wordsMin Minimum words amount
     */
    function setWordsMin($wordsMin) {
        $this->wordsMin = $wordsMin;
    }

    /**
     * Sets minimum words amount
     * @param integer $wordsMax Minimum words amount
     */
    function setWordsMax($wordsMax) {
        $this->wordsMax = $wordsMax;
    }

    /**
     * @inherit
     */
    public function get() 
    {
        $wordsAmount = $this->generateLength();
        $strRandObj = new String(2, 12);
        $strRandObj->setChars($this->getChars());

        $words = [];
        
        for ($i = 1; $i <= $wordsAmount; $i++) {
            $words[] = $strRandObj->get();
        }

        return implode(" ", $words);
    }
    
    /**
     * Returns random words amount for a paragraph (between minimum and maximum)
     * @return integer Random words amount
     */
    protected function generateLength()
    {
        $wordsMin = $this->getWordsMin();
        $wordsMax = $this->getWordsMax();
        
        if ($wordsMin > $wordsMax) {
            $buffer = $wordsMin;
            $wordsMin = $wordsMax;
            $wordsMax = $buffer;
        }
        
        if ($wordsMin < 1) {
            $wordsMin = 1;
        }
        
        if ($wordsMax > 500) {
            $wordsMax = 500;
        }
         
        return mt_rand($wordsMin, $wordsMax);
    }
    
    /**
     * @inherit
     */
    public function init($params = []) {
        if (!empty($params["words_min"])) {
            $this->setWordsMin($params["words_min"]);
        }
        
        if (!empty($params["words_max"])) {
            $this->setWordsMax($params["words_max"]);
        }
        
        parent::init($params);
    }
}
