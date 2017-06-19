<?php

namespace RandData;

/**
 * Represent entity attributes
 */
abstract class Tuple 
{
    protected $result;
    protected $datasets;
    
    /**
     * Class constructor
     */
    function __construct() 
    {
        $this->result = [];
        $this->datasets = [];
    }

    /**
     * Return entity random attribute values
     * @param integer $cnt Current counter value (when you generate many entity items
     * @return array Array of entity random attribute values
     */
    public function get($cnt = 0)
    {
        $this->result = [];
        $this->datasets = $this->getDataSets();
        $fldNames = array_keys($this->datasets);
        
        foreach ($fldNames as $fldName) {
            $set = $this->datasets[$fldName];
            
            if (is_string($set)) {
                $fabric = new \RandData\Fabric\DataSet\String();
                $set = $fabric->create($set);
            }
            
            if ($set instanceof Set\Counter) {
                $this->result[$fldName] = $set->get($cnt);
            } elseif ($set instanceof Set) {
                $this->result[$fldName] = $this->getValue($set, $fldName);
            }
        }

        return $this->result;
    }
    
    /**
     * Returns entity attribute random value
     * @param \RandData\Set $set Attribute DataSet
     * @param string $fldName Field name. If not setted, then it's index started from 1
     * @return string|null Attrubute value. Can be null sometimes (see getNullProbability() method)
     */
    protected function getValue(Set $set, $fldName)
    {
        $value = mt_rand(1, 100);
        $fldProbability = $this->getValueNullProbability($fldName);
        
        if ($fldProbability > 0 && $value <= $fldProbability) {
            return null;
        }

        return $set->get();
    }
    
    /**
     * Returns null probability for attribute
     * @param string $fldName Attribute name
     * @return integer Null probability in percents (0 - always NOT NULL, 100 - always NULL)
     */
    protected function getValueNullProbability($fldName)
    {
        $nullProbabilityList = $this->getNullProbability();

        return !empty($nullProbabilityList[$fldName])
            ? $nullProbabilityList[$fldName]
            : 0;
    }

    /**
     * Returns null probability for entity attributes
     * @return array Null probability for entity attributes in format of attributeName => NullProbability.
     * Percents, 0 - always NOT NULL, 100 - always NULL
     */
    protected function getNullProbability()
    {
        return [];
    }

    /**
     * Returns datasets definition
     * @return array Entity datasets, in format attributeName => datasetDefenition
     */
    abstract function getDataSets();
    
    /**
     * Returns entity attributes names. 
     * @return array Attribute names. If not setted, then it's index returned 
     * started from 1
     */
    public function getHeaders()
    {
        $headers = array_keys($this->getDataSets());
        
        if ($headers == range(0, count($headers) - 1)) {
            return range(1, count($headers));
        }
        
        return $headers;
    }
}
