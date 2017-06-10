<?php

namespace RandData\Formatter;

class Json extends \RandData\Formatter
{
    public function build($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    
    public function buildOne($counter, $data)
    {
        return array_combine($this->headers, $data);
    }
}
