<?php

namespace RandData;

/**
 * DataSet fabric
 */
class Fabric 
{
    /**
     * Create DataSet from string description
     * @param string $string DataSet string description
     * 
     * @return RandData\Set Generated DataSet object
     */
    public function createObjectFromString($string)
    {
        $setInfo = $this->parse($string);
        $setObj = new Set\NullValue();

        if (in_array($setInfo->getName(), [ "counter", "cnt" ])) {
            $setObj = new Set\Counter();
        } elseif (in_array($setInfo->getName(), [ "int", "integer" ])) {
            $setObj = new Set\Integer;
        } elseif ($setInfo->getName() == "float") {
            $setObj = new Set\Float();
        } elseif ($setInfo->getName() == "boolean") {
            $setObj = new Set\Boolean();
        } elseif ($setInfo->getName() == "string_list") {
            $setObj = new Set\StringList();
        } elseif ($setInfo->getName() == "string") {
            $setObj = new Set\String();
        } elseif ($setInfo->getName() == "paragraph") {
            $setObj = new Set\Paragraph();
        } elseif ($setInfo->getName() == "time") {
            $setObj = new Set\Time();
        } elseif ($setInfo->getName() == "date") {
            $setObj = new Set\Date();
        } elseif ($setInfo->getName() == "datetime") {
            $setObj = new Set\Datetime();
        } elseif ($setInfo->getName() == "phone") {
            $setObj = new Set\Phone();
        } elseif ($setInfo->getName() == "domain") {
            $setObj = new Set\Domain();
        } elseif ($setInfo->getName() == "email") {
            $setObj = new Set\Email();
        } elseif ($setInfo->getName() == "ru_person") {
            $setObj = new Set\ru_RU\Person();
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
        
        if (strpos($string, ":") !== false) {
            list($name, $paramsStr) = explode(":", $string, 2);
            $params = $this->parseParamStr($paramsStr);
        } else {
            $name = $string;
        }
        
        return new SetInfo($name, $params);
    }
    
    /**
     * 
     * @param string $paramsStr DataSet params as string. Params delimited by ; and name-value pairs delimeted by =
     * @return array An array of params
     */
    protected function parseParamStr($paramsStr) {
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
