<?php

namespace RandData\Formatter;

/**
 * Csv random data formatter
 */
class Csv extends \RandData\Formatter
{
    protected $showCounter;
    protected $headers;
    protected $showHeaders;
    protected $columnDelim;
    protected $lineDelim;
    
    /**
     * Class contructor
     * @param \RandData\Generator $generator Generator for random data
     * @param string $columnDelim How to delim columns
     */
    function __construct(\RandData\Generator $generator, $columnDelim = ";") {
        parent::__construct($generator);
        
        $this->columnDelim = $columnDelim;
        $this->showCounter = true;
        $this->showHeaders = true;
        $this->lineDelim = PHP_EOL;
    }

    /**
     * Whether to show counter
     * @param boolean $showCounter True - show, false - hide
     */
    function setShowCounter($showCounter) {
        $this->showCounter = boolval($showCounter);
    }

    /**
     * Whether to show headers
     * @param boolean $showHeaders True - show, false - hide
     */
    function setShowHeaders($showHeaders) {
        $this->showHeaders = boolval($showHeaders);
    }

    /**
     * Sets delimeters between objects
     * @param string $lineDelim Delimeters between objects
     */
    function setLineDelim($lineDelim) {
        $this->lineDelim = (string) $lineDelim;
    }
        
    /**
     * Sets column delimeter
     * @param string $columnDelim Column delimeter
     */
    function setColumnDelim($columnDelim) {
        $this->columnDelim = (string) $columnDelim;
    }

    /**
     * Builds header lime
     * @return string Header line
     */
    protected function buildHeaders()
    {
        $headers = $this->generator->getTuple()->getHeaders();
        
        return $headers
            ? ($this->showCounter ? "#" . $this->columnDelim : "") . implode($this->columnDelim, $headers) 
            : "";
    }

    /**
     * @inherited
     */
    public function buildOne($counter, $data)
    {
        foreach ($data as $fldName => $fldValue) {
            if (is_null($fldValue)) {
                $data[$fldName] = $this->getNullAs();
            }
        }

        return ($this->showCounter ? $counter . $this->columnDelim : "" )
            . implode($this->columnDelim, $data);
    }
    
    /**
     * @inherited
     */
    public function build()
    {
        $dataStr = implode($this->lineDelim, parent::build());
        return $this->showHeaders
            ? $this->buildHeaders() . $this->lineDelim . $dataStr
            : $dataStr;
    }
    
    /**
     * @inherited
     */
    protected function getNullAs()
    {
        return "NA";
    }
}
