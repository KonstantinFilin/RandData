<?php

namespace RandData\Set;

/**
 * Boolean random value
 */
class Boolean extends \RandData\Set
{
    /**
     * How to show true
     * @var string
     */
    protected $valTrue;
    
    /**
     * How to show false
     * @var string
     */
    protected $valFalse;

    /**
     * Class constructor
     * @param string $valTrue How to show true
     * @param string $valFalse How to show false
     */
    public function __construct($valTrue = "Y", $valFalse = "N")
    {
        $this->valTrue = $valTrue;
        $this->valFalse = $valFalse;
    }

    /**
     * @inherit
     */
    public function get()
    {
        $num = mt_rand(1, 100);
        return $num > 50 ? $this->valTrue : $this->valFalse;
    }

    /**
     * Returns true value representation
     * @return string True value representation
     */
    public function getValTrue()
    {
        return $this->valTrue;
    }

    /**
     * Returns false value representation
     * @return string False value representation
     */
    public function getValFalse()
    {
        return $this->valFalse;
    }

    /**
     * Sets true value representation
     * @param string $valTrue True value representation
     */
    public function setValTrue($valTrue)
    {
        $this->valTrue = $valTrue;
    }

    /**
     * Sets false value representation
     * @param string $valFalse False value representation
     */
    public function setValFalse($valFalse)
    {
        $this->valFalse = $valFalse;
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
        if (!empty($params["valTrue"])) {
            $this->setValTrue($params["valTrue"]);
        }
        
        if (!empty($params["valFalse"])) {
            $this->setValFalse($params["valFalse"]);
        }
    }
}
