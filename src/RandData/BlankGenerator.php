<?php

namespace RandData;

class BlankGenerator extends Generator
{
    protected $delimStart = "{";
    protected $delimFinish = "}";
    protected $template;
    
    function __construct(Tuple $tuple) {
        parent::__construct($tuple);
        $this->template = "";
        $this->amount = 1;
    }

    public function run() {
        $data = $this->tuple->get();
        $fields = array_keys($this->tuple->getDataSets());
        $ret = $this->template;
        
        foreach ($data as $fldName => $fldValue) {
            $search = $this->getDelimStart() . $fldName . $this->getDelimFinish();
            $ret = str_replace($search, $fldValue, $ret);
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
