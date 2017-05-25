<?php

namespace RandData\Set;

/**
 * Dataset of null values
 */
class NullValue extends \RandData\Set {

    /**
     * @inheritdoc
     */    
    public function init($params = []) {
    }
    
    /**
     * @inheritdoc
     */    
    public function get() {
        return null;
    }
}
