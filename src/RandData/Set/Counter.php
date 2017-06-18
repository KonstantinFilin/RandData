<?php

namespace RandData\Set;

/**
 * Counter dataset
 */
class Counter extends \RandData\Set
{
    /**
     * String with incremented value
     * @var string 
     */
    protected $template;
    
    /**
     * Start incremented value
     * @var integer
     */
    protected $start;
    
    /**
     * Class constructor
     */
    function __construct() {
        $this->start = 1;
        $this->template = "";
    }

    /**
     * Returns string with incremented value
     * @return string String with incremented value
     */
    function getTemplate() {
        return $this->template;
    }

    /**
     * Sets string with incremented value
     * @param string  $template String with incremented value
     */
    function setTemplate($template) {
        $this->template = $template;
    }
    
    /**
     * @inherit
     */
    public function get($cnt = 0) {
        $cnt += $this->start - 1;
        $tpl = $this->getTemplate();

        return $tpl ? str_replace("#", $cnt, $tpl) : $cnt;
    }

    /**
     * Returns start increment value
     * @return integer Start increment value
     */
    function getStart() {
        return $this->start;
    }

    /**
     * Sets start increment value
     * @param integer Start increment value
     */
    function setStart($start) {
        $this->start = $start;
    }

    /**
     * @inherit
     */
    public function init($params = array()) {
        if (!empty($params["tpl"])) {
            $this->setTemplate($params["tpl"]);
        } elseif (!empty($params["template"])) {
            $this->setTemplate($params["template"]);
        }
        
        if (!empty($params["start"])) {
            $this->setStart($params["start"]);
        }
    }
}
