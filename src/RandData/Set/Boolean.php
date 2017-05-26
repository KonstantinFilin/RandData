<?php

namespace RandData\Set;

class Boolean extends \RandData\Set 
{
    protected $valTrue;
    protected $valFalse;

    function __construct($valTrue = "Y", $valFalse = "N") {
        $this->valTrue = $valTrue;
        $this->valFalse = $valFalse;
    }

    
    public function get() 
    {
        $num = rand(1, 100);
        return $num > 50 ? $this->valTrue : $this->valFalse;
    }
    
    function getValTrue() {
        return $this->valTrue;
    }

    function getValFalse() {
        return $this->valFalse;
    }

    function setValTrue($valTrue) {
        $this->valTrue = $valTrue;
    }

    function setValFalse($valFalse) {
        $this->valFalse = $valFalse;
    }

    public function init($params = array()) 
    {
        if (!empty($params["valTrue"])) {
            $this->setValTrue($params["valTrue"]);
        }
        
        if (!empty($params["valFalse"])) {
            $this->setValFalse($params["valFalse"]);
        }
    }
}
