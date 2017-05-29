<?php

namespace RandData\Set;

class String extends \RandData\Set
{
    const CHARS_LAT_U = "ABCDEFGHIKLMNOPRSTUVWXYZ";
    const CHARS_LAT_L = "abcdefghijklmnoprstuvwxyz";
    const CHARS_DIGITS = "0123456789";
    const CHARS_PUNCTUATION = ".,!?();:";
    const CHARS_OTH = "@#$%^&*+-/";
        
    protected $lengthMin;
    protected $lengthMax;
    protected $chars;
    
    function __construct($lengthMin=1, $lengthMax=10) 
    {
        $this->lengthMin = $lengthMin;
        $this->lengthMax = $lengthMax;
        $this->chars = self::CHARS_LAT_U . self::CHARS_LAT_L . self::CHARS_DIGITS;

    }
    function getLengthMax() {
        return $this->lengthMax;
    }

    function getChars() {
        return $this->chars;
    }

    function setLengthMax($length) {
        $this->lengthMax = $length;
    }

    function getLengthMin() {
        return $this->lengthMin;
    }

    function setLengthMin($lengthMin) {
        $this->lengthMin = $lengthMin;
    }

    function addChars($chars) {
        $this->chars .= $chars;
    }
    
    function setChars($chars) {
        $this->chars = $chars;
    }

    public function get() 
    {
        $ret = "";
        $variant = $this->getChars();
        $variantLen = mb_strlen($this->getChars());
        
        $length = $this->generateLength();
        
        for ($i = 1; $i <= $length; $i++) {
            $ret .= mb_substr($variant, rand(0, $variantLen - 1), 1);
        }
        
        return $ret;
    }
    
    protected function generateLength()
    {
        $lengthMin = $this->getLengthMin();
        $lengthMax = $this->getLengthMax();
        
        if ($lengthMin > $lengthMax) {
            $buffer = $lengthMin;
            $lengthMin = $lengthMax;
            $lengthMax = $buffer;
        }
        
        if ($lengthMin < 1) {
            $lengthMin = 1;
        }
        
        if ($lengthMax > 100) {
            $lengthMax = 100;
        }
         
        return rand($lengthMin, $lengthMax);
    }

    public function init($params = array()) 
    {
        if (!empty($params["length_min"])) {
            $this->setLengthMin($params["length_min"]);
        }

        if (!empty($params["length_max"])) {
            $this->setLengthMax($params["length_max"]);
        }

        if (!empty($params["char_list"])) {
            $this->setChars($params["char_list"]);
        }
    }
}
