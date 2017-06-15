<?php

namespace RandData\Set;

class Counter extends \RandData\Set
{
    protected $template;
    protected $start;
    
    function __construct() {
        $this->start = 1;
        $this->template = "";
    }

    function getTemplate() {
        return $this->template;
    }

    function setTemplate($template) {
        $this->template = $template;
    }
    
    public function get($cnt = 0) {
        $cnt += $this->start - 1;
        $tpl = $this->getTemplate();

        return $tpl ? str_replace("#", $cnt, $tpl) : $cnt;
    }

    function getStart() {
        return $this->start;
    }

    function setStart($start) {
        $this->start = $start;
    }

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
