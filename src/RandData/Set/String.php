<?php

namespace RandData\Set;

class String extends \RandData\Set
{
    const CHARS_LAT_U = "ABCDEFGHIKLMNOPRSTUVWXYZ";
    const CHARS_LAT_L = "abcdefghijklmnoprstuvwxyz";
    const CHARS_DIGITS = "0123456789";
    const CHARS_PUNCTUATION = ".,!?();:";
    const CHARS_OTH = "@#$%^&*+-/";
        
    protected $length;
    protected $chars;
    
    function __construct($length=10) 
    {
        $this->length = $length;
        $this->chars = self::CHARS_LAT_U . self::CHARS_LAT_L . self::CHARS_DIGITS;

    }
    function getLength() {
        return $this->length;
    }

    function getChars() {
        return $this->chars;
    }

    function setLength($length) {
        $this->length = $length;
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
        
        for ($i = 1; $i <= $this->getLength(); $i++) {
            $ret .= mb_substr($variant, rand(0, $variantLen - 1), 1);
        }
        
        return $ret;
    }

    public function init($params = array()) 
    {
        if (!empty($params["length"])) {
            $this->setLength($params["length"]);
        }

        if (!empty($params["char_list"])) {
            $this->setChars($params["char_list"]);
        }
    }
}
