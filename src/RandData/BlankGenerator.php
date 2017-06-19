<?php

namespace RandData;

/**
 * Represents blank/form filling with random values. For example, 
 * input is a template "Person {name} is {age} years old" with fields "name" and "age" 
 * and Tuple that describes datasets. Fields will be filled with random values
 * as described in Tuple object
 */
class BlankGenerator extends Generator
{
    /**
     * Field start delimeter
     * @var string
     */
    protected $delimStart = "{";
    
    /**
     * Field end delimeter
     * @var string
     */
    protected $delimFinish = "}";
    
    /**
     * Template/blank/form string
     * @var string
     */
    protected $template;
    
    /**
     * Class constructor
     * @param \RandData\Tuple $tuple Tuple that describes random datasets
     * @param string $template Blank string with unmutes parts and fields for 
     * random values
     */
    function __construct(Tuple $tuple, $template = "") {
        parent::__construct($tuple);
        $this->template = (string) $template;
        $this->amount = 1;
    }

    /**
     * Returns filled string
     * @return string String with filled random values
     */
    public function run() {
        $data = $this->tuple->get();
        $ret = $this->template;
        
        foreach ($data as $fldName => $fldValue) {
            $search = $this->getDelimStart() . $fldName . $this->getDelimFinish();
            $ret = str_replace($search, $fldValue, $ret);
        }
        
        return $ret;
    }

    /**
     * Returns field start delimeter
     * @return string
     */
    function getDelimStart() {
        return $this->delimStart;
    }

    /**
     * Returns field end delimeter
     * @return string
     */
    function getDelimFinish() {
        return $this->delimFinish;
    }

    /**
     * Returns string template
     * @return string
     */
    function getTemplate() {
        return $this->template;
    }

    /**
     * Sets start delimeter
     * @param string $delimStart
     */
    function setDelimStart($delimStart) {
        $this->delimStart = (string) $delimStart;
    }

    /**
     * Sets end delimeter
     * @param string $delimFinish
     */
    function setDelimFinish($delimFinish) {
        $this->delimFinish = (string) $delimFinish;
    }
    
    /**
     * Init object
     * @param string $template Blank/form template
     */
    public function init($template)
    {
        $this->template = $template;
    }
}
