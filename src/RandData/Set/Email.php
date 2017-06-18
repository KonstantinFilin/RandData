<?php

namespace RandData\Set;

/**
 * Random email generator
 */
class Email extends \RandData\Set 
{
    /**
     * Available domain list for emails
     * @var array
     */
    protected $domainList;
    
    /**
     * Class constructor
     */
    function __construct() 
    {
        $this->domainList = [];
    }

    /**
     * Returns available domain list for email
     * @return array Available domain list for email
     */
    function getDomainList() {
        return $this->domainList;
    }

    /**
     * Sets available domain list for email
     * @param array $domainList Available domain list for email
     */
    function setDomainList($domainList) {
        $this->domainList = $domainList;
    }

    /**
     * @inherit
     */
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

    /**
     * @inherit
     */
    public function init($params = []) 
    {
        if (!empty($params["domain_list"])) {
            $this->setDomainList($params["domain_list"]);
        }
    }
}
