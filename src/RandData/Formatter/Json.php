<?php

namespace RandData\Formatter;

class Json extends \RandData\Formatter
{
    public function build()
    {
        $data = parent::build();
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    
    public function buildOne($counter, $data)
    {
        return $data;
    }
}
