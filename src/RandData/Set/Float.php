<?php

namespace RandData\Set;

/**
 * Random float generator
 */
class Float extends \RandData\Set\Integer
{
    /**
     * Minimum value
     * @var integer
     */
    protected $min;
    
    /**
     *Maximum value
     * @var integer
     */
    protected $max;
    
    /**
     * Minimum fraction gigits number
     * @var integer
     */
    protected $minFractionDigits;
    
    /**
     *Maximum digits fraction number
     * @var integer
     */
    protected $maxFractionDigits;

    /**
     * Class constructor
     * @param integer $min Minimum value
     * @param integer $max Maximum value
     */
    function __construct($min = 0, $max = 0) {
        parent::__construct($min, $max);
        $this->minFractionDigits = 0;
        $this->maxFractionDigits = 8;
    }

    /**
     * @inherit
     */
    public function get() {
        if ($this->minFractionDigits > $this->maxFractionDigits) {
            $min = $this->minFractionDigits;
            $this->minFractionDigits = $this->maxFractionDigits;
            $this->maxFractionDigits = $min;
        }
        
        $fraction = "";
        $times = mt_rand($this->minFractionDigits, $this->maxFractionDigits);
        
        for ($i = 1; $i <= $times; $i++) {
            $fraction .= mt_rand($i == $times ? 1 : 0, 9);
        }
        
        return floatval(parent::get() . "." . ( $fraction ? $fraction : 0 ));
    }

    /**
     * Returns minimum fraction digits
     * @return integer Minimum fraction digits
     */
    function getMinFractionDigits() {
        return $this->minFractionDigits;
    }

    /**
     * Returns maximum fraction digits
     * @return integer Maximum fraction digits
     */
    function getMaxFractionDigits() {
        return $this->maxFractionDigits;
    }

    /**
     * Sets minimum fraction digits 
     * @param integer $minFractionDigits Minimum fraction digits
     */
    function setMinFractionDigits($minFractionDigits) {
        $this->minFractionDigits = abs($minFractionDigits);
    }

    /**
     * Sets maximum fraction digits
     * @param integer $maxFractionDigits Maximum fraction digits
     */
    function setMaxFractionDigits($maxFractionDigits) {
        $this->maxFractionDigits = abs($maxFractionDigits);
    }
        
    /**
     * @inherit
     */
    public function init($params = []) {
        parent::init($params);
        
        if (!empty($params["minFractionDigits"])) {
            $this->setMinFractionDigits($params["minFractionDigits"]);
        }
        
        if (!empty($params["maxFractionDigits"])) {
            $this->setMaxFractionDigits($params["maxFractionDigits"]);
        }
    }
}
