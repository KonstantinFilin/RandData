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
    
    public function __construct($name, $params = [])
    {
        $this->name = (string) $name;
        $this->params = $params;
    }
    
    /**
     * Return DataSet name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return DataSet params
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Sets DataSet name
     * @param string $name DataSet name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Sets DataSet params
     * @param array DataSetParams
     */
    public function setParams($params)
    {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("Params argument must be an array");
        }
        
        $this->params = $params;
    }
}
