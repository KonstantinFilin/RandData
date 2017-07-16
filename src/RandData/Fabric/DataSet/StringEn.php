<?php

namespace RandData\Fabric\DataSet;

/**
 * English datasets fabric
 */
class StringEn
{
    /**
     * Returns english datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if ($setInfo->getName() == "en_person") {
            return new \RandData\Set\en_GB\Person();
        } elseif ($setInfo->getName() == "en_postcode") {
            return new \RandData\Set\en_GB\Postcode();
        } elseif ($setInfo->getName() == "en_city") {
            return new \RandData\Set\en_GB\City();
        } elseif ($setInfo->getName() == "en_street") {
            return new \RandData\Set\en_GB\Street();
        } elseif ($setInfo->getName() == "en_address") {
            return new \RandData\Set\en_GB\Address();
        }
        
        return null;
    }
}
