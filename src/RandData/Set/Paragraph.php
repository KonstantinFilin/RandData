<?php

namespace RandData\Set;

class Paragraph extends \RandData\Set\String
{
    protected $wordsMin;
    protected $wordsMax;

    function __construct($wordsMin = 3, $wordsMax = 100) {
        parent::__construct();
        $this->wordsMin = $wordsMin;
        $this->wordsMax = $wordsMax;
        $this->setChars(self::CHARS_LAT_L);
    }

    function getWordsMin() {
        return $this->wordsMin;
    }

    function getWordsMax() {
        return $this->wordsMax;
    }

    function setWordsMin($wordsMin) {
        $this->wordsMin = $wordsMin;
    }

    function setWordsMax($wordsMax) {
        $this->wordsMax = $wordsMax;
    }

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
         
        return rand($wordsMin, $wordsMax);
    }
    
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
