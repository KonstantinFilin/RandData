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
    protected $datePart;
    
    /**
     * Time part RandDataSet
     * @var Time
     */
    protected $timePart;
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->datePart = new Date();
        $this->timePart = new Time();
        $this->timePart->setSeconds(true);
    }
    
    /**
     * Returns date part dataset
     * @return \RandData\Set\Date
     */
    public function getD()
    {
        return $this->datePart;
    }

    /**
     * Returns time part dataset
     * @return \RandData\Set\Time
     */
    public function getT()
    {
        return $this->timePart;
    }

    /**
     * Sets date part dataset
     * @param \RandData\Set\Date $date
     */
    public function setD(Date $date)
    {
        $this->datePart = $date;
    }

    /**
     * Sets time part dataset
     * @param \RandData\Set\Time $time
     */
    public function setT(Time $time)
    {
        $this->timePart = $time;
    }

    /**
     * Sets date format
     * @param string $format Date format
     */
    public function setDateFormat($format)
    {
        $this->datePart->setFormat($format);
    }

    /**
     * @inherit
     */
    public function get()
    {
        return $this->getD()->get() . " " . $this->getT()->get();
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
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
