<?php

namespace RandData\Set;

/**
 * Dataset of integer values
 */
class Integer extends \RandData\Set
{
    /**
     * Minimum range value
     * @var integer
     */
    protected $min;
    /**
     * Maximum range value
     * @var integer
     */
    protected $max;
    /**
     *
     * @param integer $min Minimum range value. Default is 0
     * @param integer $max Maximum range value. Default is getrandmax()
     */
    public function __construct($min = 0, $max = 0)
    {
        $this->setMin($min);
        $this->setMax($max);
    }
    
    /**
     * Returns minimum range value. Default is 0
     * @return integer Minimum range value. Default is 0
     */
    public function getMin()
    {
        return $this->min;
    }
    /**
     * Returns maximum range value. Default is getrandmax()
     * @return integer Maximum range value. Default is getrandmax()
     */
    public function getMax()
    {
        return $this->max;
    }
    
    /**
     * Sets minimum range value. 
     * @param integer $min Minimum range value. Default is 0
     */
    public function setMin($min = 0)
    {
        $this->min = $min;
    }
    /**
     * Sets maximum range value. 
     * @param integer $max Maximum range value. Default is getrandmax()
     */
    public function setMax($max = 0)
    {
        $this->max = $max != 0 ? $max : getrandmax();
    }
    
    /**
     * @inheritdoc
     */
    public function get()
    {
        return rand($this->min, $this->max);
    }    

    /**
     * @inheritdoc
     */    
    public function init($params = []) {
        if (!empty($params["min"])) {
            $this->setMin(intval($params["min"]));
        }
        
        if (!empty($params["max"])) {
            $this->setMax($params["max"]);
        }
    }
}
