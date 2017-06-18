<?php

namespace RandData\Formatter;

/**
 * Json random data formatter
 */
class Json extends \RandData\Formatter
{
    /**
     * Formats all objects
     * @return string Formatted string with all objects
     */
    public function build()
    {
        $data = parent::build();
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @inherited
     */
    public function buildOne($counter, $data)
    {
        return $data;
    }
}
