<?php

namespace RandData\Fabric\DataSet;

/**
 * Special datasets fabric
 */
class StringSpecial
{
    /**
     * Returns special datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if (in_array($setInfo->getName(), [ "counter", "cnt" ])) {
            return new \RandData\Set\Counter();
        } elseif ($setInfo->getName() == "complex") {
            return new \RandData\Set\Complex();
        } elseif ($setInfo->getName() == "value") {
            return new \RandData\Set\Value();
        }
            
        return null;
    }
}
