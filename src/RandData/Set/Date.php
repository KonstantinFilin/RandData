<?php

namespace RandData\Set;

/**
 * Date random dataset
 */
class Date extends \RandData\Set
{
    /**
     * Minimum date
     * @var string
     */
    protected $min;
    
    /**
     * Maximum date
     * @var string
     */
    protected $max;
    
    /**
     * Output date format
     * @var string
     */
    protected $format;
    
    /**
     * Class constructor
     * @param string $min Minimum date in format Y-m-d
     * @param string $max Maximum date in format Y-m-d
     */
    public function __construct($min="", $max="")
    {
        $this->setMin($min);
        $this->setMax($max);
        $this->format = "Y-m-d";
    }
    
    /**
     * Returns minimum date
     * @return string Minimum date
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Returns maximum date
     * @return string maximum date
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Sets minimum date
     * @param string $min Minimum date in format Y-m-d
     */
    public function setMin($min)
    {
        $dt =  new \DateTime($min);
        
        if (!$min || !$dt) {
            $dt = new \DateTime();
            $dt->sub(new \DateInterval("P1M"));
        }

        $this->min = $dt->format("U");
    }

    /**
     * Sets maximum date
     * @param string $max Maximum date in format Y-m-d
     */
    public function setMax($max)
    {
        $dt =  new \DateTime($max);
        
        if (!$max || !$dt) {
            $dt = new \DateTime(date("Y-m-d"));
        }
        
        $this->max = $dt->format("U");
    }
    
    /**
     * Returns output date format
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets output date format
     * @param string $format Output date format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @inherit
     */
    public function get()
    {
        if ($this->min > $this->max) {
            $m = $this->min;
            $this->min = $this->max;
            $this->max = $m;
        }
        
        $ts = mt_rand($this->min, $this->max+3600*24-1);
        return date($this->format, $ts);
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
        if (!empty($params["min"])) {
            $this->setMin($params["min"]);
        }

        if (!empty($params["max"])) {
            $this->setMax($params["max"]);
        }

        if (!empty($params["format"])) {
            $this->setFormat($params["format"]);
        }
    }
}
