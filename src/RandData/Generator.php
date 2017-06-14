<?php

namespace RandData;

abstract class Generator 
{
    protected $amount;
    protected $result;

    /**
     *
     * @var Tuple
     */
    protected $tuple;
    
    /**
     *
     * @var Formatter
     */
    protected $formatter;

    function __construct(Tuple $tuple = null) {
        $this->amount = 10;
        $this->tuple = $tuple ? $tuple : new Tuple();
        $this->result = [];
        $this->buildTuple();
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

    function setTuple($tuple) {
        $this->tuple = $tuple;
    }
    
    protected function buildTuple() {
        $datasets = $this->getDataSets();

        foreach ($datasets as $ds) {
            if ($ds instanceof Set) {
                $this->tuple->addDataset($ds);
            } elseif (is_string($ds)) {
                $this->tuple->addDatasetFromStr($ds);
            }
        }
    }

    protected function getNullProbability()
    {
        return [];
    }
    
    public function processNullProbability(&$dataArr, $nullValue = null)
    {
        $headersFlipped = array_flip($this->getHeaders());
        $nullProbability = $this->getNullProbability();

        if (!$nullProbability) {
            return;
        }
        
        foreach ($nullProbability as $fldName => $fldProbability) {
            if (!array_key_exists($fldName, $headersFlipped)) {
                continue;
            }

            $idx = $headersFlipped[$fldName];
            $value = mt_rand(1, 100);

            if ($fldProbability > 0 && $value <= $fldProbability) {
                $dataArr[$idx] = $nullValue;
            }
        }
    }

    public function run() {
        $this->result = [];
        $amount = $this->getAmount();

        for ($i = 1; $i <= $amount; $i++) {
            $this->result[] = $this->runOne();
        }

        return $this->result;
    }
    
    protected function runOne() {
        $dataArr = $this->tuple->get();
        $this->processNullProbability($dataArr);
        
        return $dataArr;
    }
    
    abstract function getDataSets();
    
    public function getHeaders()
    {
        $headers = array_keys($this->getDataSets());
        
        if ($headers == range(0, count($headers) - 1)) {
            return range(1, count($headers));
        }
        
        return $headers;
    }
}
