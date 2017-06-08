<?php

namespace RandData\Set;

class Float extends \RandData\Set\Integer
{
    protected $min;
    protected $max;
    protected $minFractionDigits;
    protected $maxFractionDigits;
    
    function __construct($min = 0, $max = 0) {
        parent::__construct($min, $max);
        $this->minFractionDigits = 0;
        $this->maxFractionDigits = 8;
    }

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

    function getMinFractionDigits() {
        return $this->minFractionDigits;
    }

    function getMaxFractionDigits() {
        return $this->maxFractionDigits;
    }

    function setMinFractionDigits($minFractionDigits) {
        $this->minFractionDigits = abs($minFractionDigits);
    }

    function setMaxFractionDigits($maxFractionDigits) {
        $this->maxFractionDigits = abs($maxFractionDigits);
    }
        
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
