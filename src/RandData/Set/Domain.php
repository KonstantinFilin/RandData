<?php

namespace RandData\Set;

class Domain extends \RandData\Set
{
    protected $tldList;
    protected $chars;
    protected $charsEdge;
    protected $skipWww;

    function __construct() {
        $this->skipWww = false;
        $this->setTldList("com,edu,org,net");
        $this->setChars(String::CHARS_LAT_L . String::CHARS_DIGITS . "-");
        $this->setCharsEdge(String::CHARS_LAT_L . String::CHARS_DIGITS);
    }

    function getTldList() {
        return $this->tldList;
    }

    function getChars() {
        return $this->chars;
    }
    
    function getCharsEdge() {
        return $this->charsEdge;
    }
    
    function setTldList($tldList) {
        $this->tldList = $tldList;
    }

    function setChars($chars) {
        $this->chars = $chars;
    }
    
    public function skipWww()
    {
        $this->skipWww = true;
    }
    
    function setCharsEdge($charsFirstAndLast) {
        $this->charsEdge = $charsFirstAndLast;
    }

    public function get() 
    {
        $obj1 = new String(1, 1);
        $obj1->setChars($this->getCharsEdge());
        $obj2 = new String(1, 13);
        $obj2->setChars($this->getChars());
        $obj3 = new StringList(is_array($this->getTldList()) ? $this->getTldList() : explode(",", $this->getTldList()));
        
        return (!$this->skipWww ? "www." : "" ) . $obj1->get() . $obj2->get() . $obj1->get() . "." . $obj3->get();
    }

    public function init($params = []) 
    {
        if (!empty($params["tld_list"])) {
            $this->setTldList($params["tld_list"]);
        }
        
        if (!empty($params["char_list"])) {
            $this->setChars($params["char_list"]);
        }
        
        if (!empty($params["char_list_edge"])) {
            $this->setCharsEdge($params["char_list_edge"]);
        }
        
        if (array_key_exists("skip_www", $params)) {
            $this->skipWww = $params["skip_www"];
        }
    }
}
