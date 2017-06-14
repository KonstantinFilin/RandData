<?php

namespace RandData\Formatter;

class Csv extends \RandData\Formatter
{
    protected $showCounter;
    protected $headers;
    protected $showHeaders;
    protected $columnDelim;
    protected $lineDelim;
    
    function __construct(\RandData\Generator $generator, $columnDelim = ";") {
        parent::__construct($generator);
        
        $this->columnDelim = $columnDelim;
        $this->showCounter = true;
        $this->showHeaders = true;
        $this->lineDelim = PHP_EOL;
    }

    function setShowCounter($showCounter) {
        $this->showCounter = $showCounter;
    }

    function setShowHeaders($showHeaders) {
        $this->showHeaders = $showHeaders;
    }

    function setLineDelim($lineDelim) {
        $this->lineDelim = $lineDelim;
    }
        
    function setColumnDelim($columnDelim) {
        $this->columnDelim = $columnDelim;
    }

    protected function buildHeaders()
    {
        $headers = $this->generator->getHeaders();
        
        return $headers
            ? ($this->showCounter ? "#" . $this->columnDelim : "") . implode($this->columnDelim, $headers) 
            : "";
    }

    public function buildOne($counter, $data)
    {
        foreach ($data as $idx => $value) {
            if (is_null($value)) {
                $data[$idx] = $this->getNullAs();
            }
        }

        return ($this->showCounter ? $counter . $this->columnDelim : "" )
            . implode($this->columnDelim, $data);
    }
    
    public function build()
    {
        $dataStr = implode($this->lineDelim, parent::build());
        return $this->showHeaders
            ? $this->buildHeaders() . $this->lineDelim . $dataStr
            : $dataStr;
    }
    
    protected function getNullAs()
    {
        return "NA";
    }
}
