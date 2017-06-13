<?php

namespace RandData;

abstract class Generator 
{
    protected $amount;
    protected $counter;
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

    function __construct(Formatter $formatter = null, Tuple $tuple = null) {
        $this->counter = 0;
        $this->amount = 10;
        $this->tuple = $tuple ? $tuple : new Tuple();
        $this->formatter = $formatter ? $formatter : new Formatter();
        $this->result = [];
        $this->buildTuple();
        $this->buildFormatter();
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

    public function run() {
        $this->result = [];
        $amount = $this->getAmount();

        for ($this->counter = 1; $this->counter <= $amount; $this->counter++) {
            $this->result[] = $this->runOne();
        }

        $this->counter = 0;

        return $this->formatter->build($this->result);
    }

    protected function buildFormatter() {
        $this->formatter->setHeaders($this->getHeaders());
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
    
    private function processNullProbability(&$dataArr)
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
                $dataArr[$idx] = $this->formatter->getNullAs();
            }
        }
    }
    
    protected function runOne() {
        $dataArr = $this->tuple->get();
        $this->processNullProbability($dataArr);
        
        return $this->formatter->buildOne($this->counter, $dataArr);
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
