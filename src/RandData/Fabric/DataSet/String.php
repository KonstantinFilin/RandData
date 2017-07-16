<?php

namespace RandData\Fabric\DataSet;

/**
 * DataSets common fabric (from string)
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
        $setObj = null;
        $fabricList = [
            new StringSpecial(),
            new StringNumeric(),
            new StringText(),
            new StringDatetime(),
            new StringEn(),
            new StringRu()
        ];        
        
        while(!$setObj && $fabricList) {
            $fabric = array_shift($fabricList);
            $setObj = $fabric->create($setInfo);
        }
        
        if ($setInfo->getParams()) {
            $setObj->init($setInfo->getParams());
        }
        
        return $setObj ?: new \RandData\Set\NullValue();
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
