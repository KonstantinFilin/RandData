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

        if ($setInfo->getName() == "integer") {
            $setObj = new Set\Integer;
        } elseif ($setInfo->getName() == "float") {
            $setObj = new Set\Float();
        } elseif ($setInfo->getName() == "boolean") {
            $setObj = new Set\Boolean();
        } elseif ($setInfo->getName() == "string_list") {
            $setObj = new Set\StringList();
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
