<?php

namespace RandData\Set;

/**
 * Null value generator
 */
class NullValue extends \RandData\Set
{

    /**
     * @inheritdoc
     */
    public function init($params = [])
    {
    }
    
    /**
     * @inheritdoc
     */
    public function get()
    {
        return null;
    }
}
