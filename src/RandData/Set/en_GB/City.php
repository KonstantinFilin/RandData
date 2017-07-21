<?php

namespace RandData\Set\en_GB;

/**
 * UK city dataset
 */
class City extends \RandData\Set
{
    const VALIDATE_PATTERN = "[\w\d\s\(\)\'-]+";
    
    /**
     * Postcode of the city
     * @var string
     */
    protected $postcode;
    
    /**
     * Class constructor
     * @param string $postcode Postcode to get city from
     */
    public function __construct($postcode = "")
    {
        $this->setPostcode($postcode);
    }

    /**
     * Sets the postcode of the city
     * @param type $postcode The postcode of the city
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }
    
    /**
     * @inherit
     */
    public function get()
    {
        $cityListByPostcode = $this->getCityList();
        $cityListStr = "";
        
        if ($this->postcode) {
            $cityListStr = $this->parseDistrict($this->postcode);
        }
        
        if (!$cityListStr) {
            $cityListStr = implode(",", array_values($cityListByPostcode));
        }
        
        $cityList = explode(",", $cityListStr);
        $city = preg_replace("/\s+/", " ", $cityList[array_rand($cityList)]);
        return trim($city);
    }

    /**
     * @inherit
     */
    public function init($params = array())
    {
        if (!empty($params["postcode"])) {
            $this->setPostcode($params["postcode"]);
        }
    }

    public function parseDistrict($postcode)
    {
        $matches = [];
        $cityListStr = "";
        $cityListByPostcode = $this->getCityList();
        
        preg_match("/^([A-Za-z]{1,2})\d?/", $postcode, $matches);

        if (!empty($matches[1])) {
            if (empty($cityListByPostcode[$matches[1]])) {
                throw new \InvalidArgumentException("Doesn't exist: " . $matches[1]);
            }
            $cityListStr = $cityListByPostcode[$matches[1]];
        }
        
        return $cityListStr;
    }
    
    /**
     * Returns city list
     * @return array City list in format postcode => city1, city2, ..., cityN
     */
    protected function getCityList()
    {
        $ret = [];
        $fileContent = file(__DIR__ . "/data/city_list.csv");
        $cnt = 0;
        
        foreach ($fileContent as $line) {
            $cnt++;
            $lineTrimmed = trim ($line);
            
            if (!$lineTrimmed) {
                continue;
            }
            
            if (strpos($lineTrimmed, ";") === false) {
                throw new \Exception("No delim at line [" . $cnt . "]: " . $lineTrimmed);
            }
            list($region, $cityList) = explode(";", $lineTrimmed);
            if ($region && $cityList) {
                $ret[trim($region)] = trim($cityList);
            }
        }

        return $ret;
    }
}
