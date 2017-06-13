<?php

namespace RandData;

class Formatter 
{
    protected $headers;

    function setHeaders($headers) {
        $this->headers = $headers;
    }
        
    public function buildOne($counter, $data)
    {
        return $data;
    }
    
    public function build($data)
    {
        return $data;
    }
    
    public function getNullAs() {
        return null;
    }
}
