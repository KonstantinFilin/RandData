<?php

namespace RandData\Set;

class Time extends \RandData\Set
{
    protected $min;
    protected $max;
    protected $seconds;

    function __construct($min = 0, $max = 0) {
        $this->min = $min;
        $this->max = $max ?: 60*24 - 1;
        $this->seconds = false;
    }

    function getMin() {
        return $this->min;
    }

    function getMax() {
        return $this->max;
    }

    function setMin($min) {
        $this->min = $min;
    }

    function setMax($max) {
        $this->max = $max;
    }
    
    function getSeconds() {
        return $this->seconds;
    }

    function setSeconds($seconds) {
        $this->seconds = $seconds;
    }
    
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

    public function fromMin($min)
    {
        return sprintf("%02u", floor($min / 60)) . ":" . sprintf("%02.0u", $min % 60);
    }

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
