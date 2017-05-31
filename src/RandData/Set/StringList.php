<?php

namespace RandData\Set;

class StringList extends \RandData\Set
{
    protected $values;
    
    function __construct($values = [ "abc", "def", "ghi", "klm", "nop" ]) {
        $this->values = $values;
    }
    
    public function get() {
        $key = array_rand($this->values);
        return $this->values[$key];
    }
    
    function getValues() {
        return $this->values;
    }

    function setValues($values) {
        $this->values = $values;
    }

    public function init($params = []) {
        if (!empty($params["values"])) {
            $this->setValues($params["values"]);
        }
    }
}
