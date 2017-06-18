<?php

namespace RandData\Set;

/**
 * Random datetime value
 */
class Datetime extends \RandData\Set 
{
    /**
     * Date part RandDataSet
     * @var Date
     */
    protected $d;
    
    /**
     * Time part RandDataSet
     * @var Time
     */
    protected $t;
    
    /**
     * Class constructor
     */
    function __construct() {
        $this->d = new Date();
        $this->t = new Time();
        $this->t->setSeconds(true);
    }
    
    /**
     * Returns date part dataset
     * @return \RandData\Set\Date 
     */
    function getD() {
        return $this->d;
    }

    /**
     * Returns time part dataset
     * @return \RandData\Set\Time
     */
    function getT() {
        return $this->t;
    }

    /**
     * Sets date part dataset
     * @param \RandData\Set\Date $d
     */
    function setD(Date $d) {
        $this->d = $d;
    }

    /**
     * Sets time part dataset
     * @param \RandData\Set\Time $t
     */
    function setT(Time $t) {
        $this->t = $t;
    }

    /**
     * Sets date format
     * @param string $format Date format
     */
    public function setDateFormat($format)
    {
        $this->d->setFormat($format);
    }

    /**
     * @inherit
     */
    public function get() {
        return $this->getD()->get() . " " . $this->getT()->get();
    }

    /**
     * @inherit
     */
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
