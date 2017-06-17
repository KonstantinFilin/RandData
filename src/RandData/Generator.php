<?php

namespace RandData;

class Generator 
{
    protected $amount;

    /**
     *
     * @var Tuple
     */
    protected $tuple;

    function __construct(Tuple $tuple, $amount = 10) {
        $this->amount = $amount;
        $this->tuple = $tuple;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function getAmount() {
        return $this->amount;
    }

    function getTuple() {
        return $this->tuple;
    }

    public function run() {
        $result = [];
        $amount = $this->getAmount();

        for ($i = 1; $i <= $amount; $i++) {
            $result[] = $this->tuple->get($i);
        }
        
        return $result;
    }
}
