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
    public function __construct($min = "", $max = "")
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
        $dtMin =  new \DateTime($min);
        
        if (!$min || !$dtMin) {
            $dtMin = new \DateTime();
            $dtMin->sub(new \DateInterval("P1M"));
        }

        $this->min = $dtMin->format("U");
    }

    /**
     * Sets maximum date
     * @param string $max Maximum date in format Y-m-d
     */
    public function setMax($max)
    {
        $dtMax =  new \DateTime($max);
        
        if (!$max || !$dtMax) {
            $dtMax = new \DateTime(date("Y-m-d"));
        }
        
        $this->max = $dtMax->format("U");
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
            $min = $this->min;
            $this->min = $this->max;
            $this->max = $min;
        }
        
        $timestampRand = mt_rand($this->min, $this->max+3600*24-1);
        return date($this->format, $timestampRand);
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
