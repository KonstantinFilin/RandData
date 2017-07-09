<?php

namespace RandData\Set;

/**
 * One-value dataset
 */
class Value extends \RandData\Set
{
    /**
     * The single value to generate
     * @var mixed
     */
    protected $value;
    
    /**
     * Class constructor
     * @param mixed $value The single value to return
     */
    function __construct($value = "") {
        $this->value = $value;
    }

    /**
     * @inherit
     */
    public function get() {
        return $this->value;
    }

    /**
     * @inherit
     */
    public function init($params = array()) {
        if (!empty($params["value"])) {
            $this->value = $params["value"];
        }
    }
}
