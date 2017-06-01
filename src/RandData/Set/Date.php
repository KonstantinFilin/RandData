<?php

namespace RandData\Set;

class Date extends \RandData\Set 
{
    protected $min;
    protected $max;
    protected $format;
    
    function __construct($min="", $max="") {
        $this->setMin($min);
        $this->setMax($max);
        $this->format = "Y-m-d";
    }
    
    function getMin() {
        return $this->min;
    }

    function getMax() {
        return $this->max;
    }

    function setMin($min) {
        $dt =  new \DateTime($min);
        
        if (!$min || !$dt) {
            $dt = new \DateTime();
            $dt->sub(new \DateInterval("P1M"));
        }

        $this->min = $dt->format("U");
    }

    function setMax($max) {
        $dt =  new \DateTime($max);
        
        if (!$max || !$dt) {
            $dt = new \DateTime(date("Y-m-d"));
        }
        
        $this->max = $dt->format("U");
    }
    
    function getFormat() {
        return $this->format;
    }

    function setFormat($format) {
        $this->format = $format;
    }

    public function get() {
        if ($this->min > $this->max) {
            $m = $this->min;
            $this->min = $this->max;
            $this->max = $m;
        }
        
        $ts = rand($this->min, $this->max+3600*24-1);
        return date($this->format, $ts);
    }

    public function init($params = []) {
        if (!empty($params["min"])) {
            $this->setMin($params["min"]);
        }

        if (!empty($params["max"])) {
            $this->setMax($params["max"]);
        }

        if (!empty($params["format"])) {
            $this->setFormat($params["format"]);
        }
    }
}
