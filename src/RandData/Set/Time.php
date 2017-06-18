<?php

namespace RandData\Set;

/**
 * Random time generator
 */
class Time extends \RandData\Set
{
    /**
     * Minimum time
     * @var string
     */
    protected $min;
    
    /**
     * Maximum time
     * @var string
     */
    protected $max;
    
    /**
     * Whether to show seconds
     * @var boolean
     */
    protected $seconds;

    /**
     * Class constructor
     * @param string $min Minimum time
     * @param string $max Maximum time
     */
    function __construct($min = 0, $max = 0) {
        $this->min = $min;
        $this->max = $max ?: 60*24 - 1;
        $this->seconds = false;
    }

    /**
     * Returns minimum possible time
     * @return string Minimum possible time
     */
    function getMin() {
        return $this->min;
    }

    /**
     * Return maximum possible time
     * @return string Maximum possible time
     */
    function getMax() {
        return $this->max;
    }

    /**
     * Sets minimum possible time
     * @param string $min Minimum possible time
     */
    function setMin($min) {
        $this->min = $min;
    }

    /**
     * Sets maximum possible time
     * @param string $max Maximum possible time
     */
    function setMax($max) {
        $this->max = $max;
    }
    
    /**
     * Whether to show seconds
     * @return boolean True - show seconds, false - hide seconds
     */
    function getSeconds() {
        return $this->seconds;
    }

    /**
     * Sets whether to show seconds
     * @param boolean $seconds True - show seconds, false - hide seconds
     */
    function setSeconds($seconds) {
        $this->seconds = $seconds;
    }
    
    /**
     * @inherit
     */
    public function get() {
        $min = $this->getMin();
        $max = $this->getMax();
        
        if (!is_integer($min)) {
            $min = $this->toMin($min);
        }
        
        if (!is_integer($max)) {
            $max = $this->toMin($max);
        }
        
        if ($min > $max) {
            $m = $min;
            $min = $max;
            $max = $m;
        }
        
        $value = $this->fromMin(mt_rand($min, $max));
        
        if ($this->getSeconds()) {
            $value .= ":" . sprintf("%02u", mt_rand(0, 59));
        }
        
        return $value;
    }

    /**
     * @inherit
     */
    public function init($params = []) {
        if (!empty($params["min"])) {
            $this->setMin($params["min"]);
        }

        if (!empty($params["max"])) {
            $this->setMax($params["max"]);
        }

        if (!empty($params["seconds"])) {
            $this->setSeconds($params["seconds"]);
        } else {
            $this->setSeconds(false);
        }
    }

    /**
     * Returns time from minutes amount
     * @param integer $min Minutes amount
     * @return string Time in format hh:mm
     */
    public function fromMin($min)
    {
        return sprintf("%02u", floor($min / 60)) . ":" . sprintf("%02.0u", $min % 60);
    }

    /**
     * Returns minutes amount from time value
     * @param string $time Time in format hh:mm
     * @return integer Minutes amount
     */
    public function toMin($time)
    {
        if (strlen($time) == 5) {
            list($h, $m) = explode(":", $time);
            return $h * 60 + $m;
        }

        if (strlen($time) == 7) {
            list($h, $m, ) = explode(":", $time);
            return $h * 60 + $m;
        }
        
        return 0;
    }
}
