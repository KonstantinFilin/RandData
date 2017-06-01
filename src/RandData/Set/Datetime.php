<?php

namespace RandData\Set;

class Datetime extends \RandData\Set 
{
    /**
     *
     * @var Date
     */
    protected $d;
    
    /**
     *
     * @var Time
     */
    protected $t;
    
    function __construct() {
        $this->d = new Date();
        $this->t = new Time();
        $this->t->setSeconds(true);
    }
    
    function getD() {
        return $this->d;
    }

    function getT() {
        return $this->t;
    }

    function setD(Date $d) {
        $this->d = $d;
    }

    function setT(Time $t) {
        $this->t = $t;
    }

    public function setDateFormat($format)
    {
        $this->d->setFormat($format);
    }

    public function get() {
        return $this->getD()->get() . " " . $this->getT()->get();
    }

    public function init($params = []) {
        if (!empty($params["time_min"])) {
            $this->getT()->setMin($params["time_min"]);
        }
        
        if (!empty($params["time_max"])) {
            $this->getT()->setMax($params["time_max"]);
        }
        
        if (array_key_exists("seconds", $params)) {
            $this->getT()->setSeconds($params["seconds"]);
        } else {
            $this->getT()->setSeconds(true);
        }

        if (!empty($params["date_min"])) {
            $this->getD()->setMin($params["date_min"]);
        }
        
        if (!empty($params["date_max"])) {
            $this->getD()->setMax($params["date_max"]);
        }
        
        if (!empty($params["date_format"])) {
            $this->getD()->setFormat($params["date_format"]);
        }
    }
}
