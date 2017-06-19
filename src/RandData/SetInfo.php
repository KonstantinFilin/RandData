<?php

namespace RandData;

/**
 * DataSet meta information
 */
class SetInfo 
{
    /**
     * Name of the DataSet
     * @var string
     */
    protected $name;
    
    /**
     * Params of the DataSet
     * @var array
     */
    protected $params;
    
    function __construct($name, $params = []) {
        $this->name = (string) $name;
        $this->params = $params;
    }
    
    /**
     * Return DataSet name
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /**
     * Return DataSet params
     * @return array
     */
    function getParams() {
        return $this->params;
    }

    /**
     * Sets DataSet name
     * @param string $name DataSet name
     */
    function setName($name) {
        $this->name = (string) $name;
    }

    /**
     * Sets DataSet params
     * @param array DataSetParams
     */
    function setParams($params) {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("Params argument must be an array");
        }
        
        $this->params = $params;
    }
}
