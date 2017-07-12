<?php

namespace RandData\Fabric\DataSet;

/**
 * DataSet string fabric
 */
class String
{
    /**
     * Create DataSet from string description
     * @param string $string DataSet string description
     *
     * @return RandData\Set Generated DataSet object
     */
    public function create($string)
    {
        $setInfo = $this->parse($string);
        $setObj = new \RandData\Set\NullValue();

        if (in_array($setInfo->getName(), [ "counter", "cnt" ])) {
            $setObj = new \RandData\Set\Counter();
        } elseif (in_array($setInfo->getName(), [ "int", "integer" ])) {
            $setObj = new \RandData\Set\Integer;
        } elseif ($setInfo->getName() == "complex") {
            $setObj = new \RandData\Set\Complex();
        } elseif ($setInfo->getName() == "decimal") {
            $setObj = new \RandData\Set\Decimal();
        } elseif ($setInfo->getName() == "boolean") {
            $setObj = new \RandData\Set\Boolean();
        } elseif ($setInfo->getName() == "string_list") {
            $setObj = new \RandData\Set\StringList();
        } elseif ($setInfo->getName() == "string") {
            $setObj = new \RandData\Set\String();
        } elseif ($setInfo->getName() == "paragraph") {
            $setObj = new \RandData\Set\Paragraph();
        } elseif ($setInfo->getName() == "time") {
            $setObj = new \RandData\Set\Time();
        } elseif ($setInfo->getName() == "date") {
            $setObj = new \RandData\Set\Date();
        } elseif ($setInfo->getName() == "datetime") {
            $setObj = new \RandData\Set\Datetime();
        } elseif ($setInfo->getName() == "phone") {
            $setObj = new \RandData\Set\Phone();
        } elseif ($setInfo->getName() == "domain") {
            $setObj = new \RandData\Set\Domain();
        } elseif ($setInfo->getName() == "email") {
            $setObj = new \RandData\Set\Email();
        } elseif ($setInfo->getName() == "value") {
            $setObj = new \RandData\Set\Value();
        } elseif ($setInfo->getName() == "en_person") {
            $setObj = new \RandData\Set\en_GB\Person();
        } elseif ($setInfo->getName() == "en_postcode") {
            $setObj = new \RandData\Set\en_GB\Postcode();
        } elseif ($setInfo->getName() == "en_city") {
            $setObj = new \RandData\Set\en_GB\City();
        } elseif ($setInfo->getName() == "en_street") {
            $setObj = new \RandData\Set\en_GB\Street();
        } elseif ($setInfo->getName() == "en_address") {
            $setObj = new \RandData\Set\en_GB\Address();
        } elseif ($setInfo->getName() == "ru_city") {
            $setObj = new \RandData\Set\ru_RU\City();
        } elseif ($setInfo->getName() == "ru_person") {
            $setObj = new \RandData\Set\ru_RU\Person();
        } elseif ($setInfo->getName() == "ru_postcode") {
            $setObj = new \RandData\Set\ru_RU\PostCode();
        } elseif ($setInfo->getName() == "ru_street") {
            $setObj = new \RandData\Set\ru_RU\Street();
        } elseif ($setInfo->getName() == "ru_address") {
            $setObj = new \RandData\Set\ru_RU\Address();
        }
        
        if ($setInfo->getParams()) {
            $setObj->init($setInfo->getParams());
        }
        
        return $setObj;
    }
    
    /**
     * Parses DataSet string description and creates DataSetInfo object
     * @param string $string DataSet string description
     * @return SetInfo DataSet meta
     */
    protected function parse($string)
    {
        $name = "";
        $params = [];
        
        if (($pos = strpos($string, ":")) !== false) {
            $name = substr($string, 0, $pos);
            $paramsStr = substr($string, $pos+1);
            $params = $name == "complex" ? $paramsStr : $this->parseParamStr($paramsStr);
        } else {
            $name = $string;
        }
        
        return new \RandData\SetInfo($name, $params);
    }
    
    /**
     *
     * @param string $paramsStr DataSet params as string. Params delimited by ; and name-value pairs delimeted by =
     * @return array An array of params
     */
    protected function parseParamStr($paramsStr)
    {
        $paramPairs = explode(";", $paramsStr);
        $params = [];
        
        foreach ($paramPairs as $paramPair) {
            if (strpos($paramPair, "=")) {
                list($key, $value) = explode("=", $paramPair);
                $params[$key] = strpos($value, ",") ? explode(",", $value) : $value;
            } else {
                new \InvalidArgumentException("Wrong params: must be key=value pairs");
            }
        }
        
        return $params;
    }
}
