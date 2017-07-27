<?php

namespace RandData\Set;

/**
 * Random phone generator
 */
class Phone extends \RandData\Set
{
    const COUNTRY_CODE_MIN = 1;
    const COUNTRY_CODE_MAX = 9;
    const REGION_CODE_MIN = 100;
    const REGION_CODE_MAX = 9999;
    
    /**
     * List of available country codes
     * @var Array
     */
    protected $countryList;
    
    /**
     * List of available region codes
     * @var array
     */
    protected $regionList;
    
    /**
     * Whether to format phone number
     * @var boolean
     */
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
    
    /**
     * Class constructor
     */
    public function __construct()
    {
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

    /**
     * Returns local part of the phone
     * @param integer $length Local part length
     * @return string Local part of the phone
     */
    private function getFinish($length)
    {
        $strGenerator = new Str();
        $strGenerator->setChars(\RandData\Set\Str::CHARS_DIGITS);
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
    
    /**
     * Returns country and region parts of the phone
     * @return string Country and region part
     */
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
    
    /**
     * @inherit
     */
    public function get()
    {
        $start = $this->getStart();
        $length = 11 - mb_strlen(preg_replace("/[\D]+/", "", $start));
        $finish = $this->getFinish($length);
        
        return $start . $finish;
    }
    
    /**
     * @inherit
     */
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
    
    /**
     * Returns available country codes list
     * @return array Available country codes list
     */
    public function getCountryList()
    {
        return $this->countryList;
    }

    /**
     * Returns available region codes list
     * @return array Available region codes list
     */
    public function getRegionList()
    {
        return $this->regionList;
    }

    /**
     * Sets available country codes list
     * @param type $countryList Available country codes list
     * @throws \InvalidArgumentException When wrong country code was passed
     */
    public function setCountryList($countryList)
    {
        if (!is_array($countryList)) {
            $countryList = [ $countryList ];
        }
        
        foreach ($countryList as $idx => $code) {
            $countryList[$idx] = \RandData\Checker::int(
                $code,
                self::COUNTRY_CODE_MIN,
                self::COUNTRY_CODE_MAX,
                "countryCode"
            );
        }
        
        $this->countryList = $countryList;
    }

    /**
     * Sets available region codes list
     * @param array $regionList Available region codes list
     * @throws \InvalidArgumentException When wrong region code was passed
     */
    public function setRegionList($regionList)
    {
        if (!is_array($regionList)) {
            $regionList = [ $regionList ];
        }
        
        foreach ($regionList as $idx => $code) {
            $regionList[$idx] = \RandData\Checker::int(
                $code,
                self::REGION_CODE_MIN,
                self::REGION_CODE_MAX,
                "regionCode"
            );
        }
        
        $this->regionList = $regionList;
    }

    /**
     * Returns whether to format phone number
     * @return string True - formated, false - non formatted
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets whether to format phone number
     * @param boolean $format True - formatted, false - non formatted
     */
    public function setFormat($format)
    {
        $this->format = boolval($format);
    }
}
