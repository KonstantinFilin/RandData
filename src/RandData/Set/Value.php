<?php

namespace RandData\Set;

class Value extends \RandData\Set
{
    protected $value;
    
    function __construct($value = "") {
        $this->value = $value;
    }

    public function get() {
        return $this->value;
    }

    public function init($params = array()) {
        if (!empty($params["value"])) {
            $this->value = $params["value"];
        }
    }
}
