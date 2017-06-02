<?php

namespace RandData\Set;

class Phone extends \RandData\Set 
{
    protected $countryList;
    protected $regionList;
    protected $format;
    
    const COUNTRY_CODE_AMERICA_NORTH = 1;
    const COUNTRY_CODE_AFRICA = 2;
    const COUNTRY_CODE_EUROPE_1 = 3;
    const COUNTRY_CODE_EUROPE_2 = 4;
    const COUNTRY_CODE_AMERICA_CENTRAL_SOUTH = 5;
    const COUNTRY_CODE_ASIA_1 = 6;
    const COUNTRY_CODE_RUSSIA = 7;
    const COUNTRY_CODE_ASIA_2 = 8;
    const COUNTRY_CODE_ASIA_3 = 9;
    
    function __construct() {
        $this->countryList = [
            self::COUNTRY_CODE_AMERICA_NORTH,
            self::COUNTRY_CODE_AFRICA,
            self::COUNTRY_CODE_EUROPE_1,
            self::COUNTRY_CODE_EUROPE_2,
            self::COUNTRY_CODE_AMERICA_CENTRAL_SOUTH,
            self::COUNTRY_CODE_ASIA_1,
            self::COUNTRY_CODE_RUSSIA,
            self::COUNTRY_CODE_ASIA_2,
            self::COUNTRY_CODE_ASIA_3,
        ];
        
        $this->regionList = [
            "123", "456", "789", 
            "111", "222", "333", 
            "444", "555", "666", 
            "777", "888", "999"
        ];
        
        $this->format = true;
    }

    private function getFinish($length) 
    {
        $strGenerator = new String();
        $strGenerator->setChars(\RandData\Set\String::CHARS_DIGITS);
        $strGenerator->setLengthMin(3);
        $strGenerator->setLengthMax(3);
        $part3 = $strGenerator->get();
        
        if ($length == 7) {
            $strGenerator->setLengthMin(2);
            $strGenerator->setLengthMax(2);
            
            return $this->format 
                ? $part3 . "-" . $strGenerator->get() . "-" . $strGenerator->get() 
                : $part3 . $strGenerator->get() . $strGenerator->get();
        } else {
            return $this->format 
                ? $part3 . "-" . $strGenerator->get() 
                : $part3 . $strGenerator->get();
        }
    }
    
    private function getStart() 
    {
        $countryCodes = $this->getCountryList();
        $regionCodes = $this->getRegionList();
        $part1 = $countryCodes[array_rand($countryCodes)];
        $part2 = $regionCodes[array_rand($regionCodes)];
        
        return $this->format 
            ? "+" . $part1 . " (" . $part2 . ") " 
            : $part1 . $part2;
    } 
    
    public function get() 
    {
        $start = $this->getStart();
        $length = 11 - mb_strlen(preg_replace("/[\D]+/", "", $start));
        $finish = $this->getFinish($length);
        
        return $start . $finish;
    }
    
    public function init($params = []) 
    {
        if (!empty($params["country_list"])) {
            $this->setCountryList($params["country_list"]);
        }

        if (!empty($params["region_list"])) {
            $this->setRegionList($params["region_list"]);
        }

        if (array_key_exists("format", $params)) {
            $this->setFormat($params["format"]);
        }
    }
    
    function getCountryList() {
        return $this->countryList;
    }

    function getRegionList() {
        return $this->regionList;
    }

    function setCountryList($countryList) {
        
        if (!is_array($countryList)) {
            $countryList = [ $countryList ];
        }
        
        foreach ($countryList as $idx => $code) {
            $codeInt = intval($code);
            
            if ($codeInt < 1 || $codeInt > 9) {
                throw new \InvalidArgumentException("Country code must be one digit from 1 to 9 [" . $codeInt . "]");
            }
            
            $countryList[$idx] = $codeInt;
        }
        
        $this->countryList = $countryList;
    }

    function setRegionList($regionList) {
        
        if (!is_array($regionList)) {
            $regionList = [ $regionList ];
        }
        
        foreach ($regionList as $idx => $code) {
            $codeInt = intval($code);
            
            if ($codeInt < 100 || $codeInt > 9999) {
                throw new \InvalidArgumentException("Country code must be one digit from 1 to 9");
            }
            
            $regionList[$idx] = $code;
        }
        
        $this->regionList = $regionList;
    }

    function getFormat() {
        return $this->format;
    }

    function setFormat($format) {
        $this->format = $format;
    }
}
