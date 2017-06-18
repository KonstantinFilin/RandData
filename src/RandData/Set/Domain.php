<?php

namespace RandData\Set;

/**
 * Random internet domain
 */
class Domain extends \RandData\Set
{
    /**
     * Available top level domain list
     * @var array
     */
    protected $tldList;
    
    /**
     * Available chars
     * @var string
     */
    protected $chars;
    
    /**
     * Available chars for first and last position in domain 
     * @var string
     */
    protected $charsEdge;
    
    /**
     * Whether to show www. prefix
     * @var type 
     */
    protected $skipWww;

    /**
     * Class constructor
     */
    function __construct() {
        $this->skipWww = false;
        $this->setTldList("com,edu,org,net");
        $this->setChars(String::CHARS_LAT_L . String::CHARS_DIGITS . "-");
        $this->setCharsEdge(String::CHARS_LAT_L . String::CHARS_DIGITS);
    }

    /**
     * Returns available top level domains list 
     * @return array Top level domains list
     */
    function getTldList() {
        return $this->tldList;
    }

    /**
     * Returns available chars for the domain
     * @return string Available chars for the domain
     */
    function getChars() {
        return $this->chars;
    }
    
    /**
     * Returns available chars for first and last position in the domain
     * @return type
     */
    function getCharsEdge() {
        return $this->charsEdge;
    }
    
    /**
     * Sets available top level domain list
     * @param array $tldList Available top level domain list
     */    
    function setTldList($tldList) {
        $this->tldList = $tldList;
    }

    /**
     * Sets available chars for domain name
     * @param string $chars Available chars for domain name
     */
    function setChars($chars) {
        $this->chars = $chars;
    }
    
    /**
     * Don't show www. prefix
     */
    public function skipWww()
    {
        $this->skipWww = true;
    }
    
    /**
     * Sets available chars for first and last position of domain
     * @param type $charsFirstAndLast
     */
    function setCharsEdge($charsFirstAndLast) {
        $this->charsEdge = $charsFirstAndLast;
    }

    /**
     * @inherit
     */
    public function get() 
    {
        $obj1 = new String(1, 1);
        $obj1->setChars($this->getCharsEdge());
        $obj2 = new String(1, 13);
        $obj2->setChars($this->getChars());
        $obj3 = new StringList(is_array($this->getTldList()) ? $this->getTldList() : explode(",", $this->getTldList()));
        
        return (!$this->skipWww ? "www." : "" ) . $obj1->get() . $obj2->get() . $obj1->get() . "." . $obj3->get();
    }

    /**
     * @inherit
     */
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
