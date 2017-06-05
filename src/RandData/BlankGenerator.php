<?php

namespace RandData;

abstract class BlankGenerator extends Generator
{
    protected $delimStart = "{";
    protected $delimFinish = "}";
    protected $template;
    
    function __construct(Tuple $tuple = null) {
        parent::__construct($tuple);
        $this->template = "";
        $this->amount = 1;
    }

    public function run() {
        $data = $this->tuple->get();
        $fields = array_keys($this->getDataSets());
        $ret = $this->template;
        
        foreach ($fields as $idx => $field) {
            $search = $this->getDelimStart() . $field . $this->getDelimFinish();
            $ret = str_replace($search, $data[$idx], $ret);
        }
        
        return $ret;
    }

    function getDelimStart() {
        return $this->delimStart;
    }

    function getDelimFinish() {
        return $this->delimFinish;
    }

    function getTemplate() {
        return $this->template;
    }

    function setDelimStart($delimStart) {
        $this->delimStart = $delimStart;
    }

    function setDelimFinish($delimFinish) {
        $this->delimFinish = $delimFinish;
    }
        
    public function init($template)
    {
        $this->template = $template;
    }
}
