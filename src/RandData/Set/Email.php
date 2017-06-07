<?php

namespace RandData\Set;

class Email extends \RandData\Set 
{
    protected $domainList;
    
    function __construct() 
    {
        $this->domainList = [];
    }

    function getDomainList() {
        return $this->domainList;
    }

    function setDomainList($domainList) {
        $this->domainList = $domainList;
    }

    public function get() 
    {
        $domainList = $this->getDomainList();
        $domain = "";
        
        if ($domainList) {
            $obj1 = new StringList();
            $obj1->setValues(is_array($domainList) ? $domainList : explode(",", $domainList));
            $domain = $obj1->get();
        } else {
            $obj2 = new Domain();
            $obj2->skipWww();
            $domain = $obj2->get();
        }
        
        $loginChars = "abcdefghijklmnopqrstunwxyz0123456789";
        $obj3 = new String(1, 15);
        $obj3->setChars($loginChars);

        return $obj3->get() . "@" . $domain;
    }

    public function init($params = []) 
    {
        if (!empty($params["domain_list"])) {
            $this->setDomainList($params["domain_list"]);
        }
    }
}
