<?php

namespace RandData;

/**
 * Generates a list of random objects
 */
class Generator 
{
    const AMOUNT_MIN = 1;
    const AMOUNT_MAX = 10000000;
    
    /**
     * Amount of generated objects
     * @var integer
     */
    protected $amount;

    /**
     *
     * @var Tuple
     */
    protected $tuple;

    /**
     * Class constructor
     * @param \RandData\Tuple $tuple Tuple for entity
     * @param integer $amount Amount of items in list
     */
    function __construct(Tuple $tuple, $amount = 10) {
        $this->amount = Checker::int($amount, self::AMOUNT_MIN, self::AMOUNT_MAX, "amount");
        $this->tuple = $tuple;
    }

    /**
     * Sets the length of entity list
     * @param integer $amount The length of entity list
     */
    function setAmount($amount) {
        $this->amount = Checker::int($amount, self::AMOUNT_MIN, self::AMOUNT_MAX, "amount");
    }

    /**
     * Returns the length of entity list
     * @return integer $amount The length of entity list
     */
    function getAmount() {
        return $this->amount;
    }

    /**
     * Returns entity Tuple object
     * @return \RandData\Tuple Entity Tuple object
     */
    function getTuple() {
        return $this->tuple;
    }

    /**
     * Builds an list of random objects
     * @return array Array of random objects, each item is an array of object attributes
     */
    public function run() {
        $result = [];
        $amount = $this->getAmount();

        for ($i = 1; $i <= $amount; $i++) {
            $result[] = $this->tuple->get($i);
        }
        
        return $result;
    }
}
