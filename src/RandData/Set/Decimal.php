<?php

namespace RandData\Set;

/**
 * Random decimal generator
 */
class Decimal extends \RandData\Set\Integer
{
    const MIN_MIN = -10000000;
    const MIN_MAX = 10000000;
    const MAX_MIN = -10000000;
    const MAX_MAX = 10000000;
    const FRACTION_MIN = 0;
    const FRACTION_MAX = 20;
    
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
        $minClean = \RandData\Checker::int($min, self::MIN_MIN, self::MIN_MAX, "min");
        $maxClean = \RandData\Checker::int($max, self::MAX_MIN, self::MAX_MAX, "max");
        parent::__construct($minClean, $maxClean);
        $this->minFractionDigits = self::FRACTION_MIN;
        $this->maxFractionDigits = self::FRACTION_MAX;
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
        $this->minFractionDigits = \RandData\Checker::int(
            $minFractionDigits, 
            self::FRACTION_MIN, 
            self::FRACTION_MAX, 
            "minFractionDigits"
        );
    }

    /**
     * Sets maximum fraction digits
     * @param integer $maxFractionDigits Maximum fraction digits
     */
    function setMaxFractionDigits($maxFractionDigits) {
        $this->maxFractionDigits = \RandData\Checker::int(
            $maxFractionDigits, 
            self::FRACTION_MIN, 
            self::FRACTION_MAX, 
            "maxFractionDigits"
        );
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
