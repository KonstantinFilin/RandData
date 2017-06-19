<?php

namespace RandData\Set;

/**
 * Dataset of integer values
 */
class Integer extends \RandData\Set
{
    const MIN_MIN = -10000;
    const MIN_MAX = 10000000;
    const MAX_MIN = -10000;
    const MAX_MAX = 10000000;

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
        $this->min = \RandData\Checker::int($min, self::MIN_MIN, self::MIN_MAX, "min");
    }
    /**
     * Sets maximum range value. 
     * @param integer $max Maximum range value. Default is getrandmax()
     */
    public function setMax($max = 0)
    {
        $this->max = \RandData\Checker::int($max, self::MAX_MIN, self::MAX_MAX, "max");
    }
    
    /**
     * @inheritdoc
     */
    public function get()
    {
        if ($this->min > $this->max) {
            $min = $this->min;
            $this->min = $this->max;
            $this->max = $min;
        }

        return mt_rand($this->min, $this->max);
    }    

    /**
     * @inheritdoc
     */    
    public function init($params = []) {
        if (!empty($params["min"])) {
            $this->setMin(intval($params["min"]));
        }
        
        if (!empty($params["max"])) {
            $this->setMax(intval($params["max"]));
        }
    }
}
