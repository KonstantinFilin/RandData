<?php

namespace RandData\Set;

/**
 * Complex dataset
 */
class Complex extends \RandData\Set
{
    /**
     * Template string
     * @var string
     */
    protected $template;

    /**
     * Class constructor
     */
    public function __construct($template = "")
    {
        $this->template = (string) $template;
    }

    /**
     * @inherit
     */
    public function get()
    {
        $matches = [];
        $ret = $this->template;
        $fabric = new \RandData\Fabric\DataSet\Str();
       
        preg_match_all("/{([^}]+)}/", $ret, $matches);
        $data = !empty($matches[1]) ? $matches[1] : [];
        
        foreach ($data as $randdataStr) {
            $dataSet = $fabric->create($randdataStr);
            $search = "{" . $randdataStr . "}";
            $ret = str_replace($search, $dataSet->get(), $ret);
        }
        
        return $ret;
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
        if (is_string($params)) {
            $this->template = $params;
        } elseif (!empty($params["template"])) {
            $this->template = $params["template"];
        }
//        var_dump($this->template); die;
    }
}
