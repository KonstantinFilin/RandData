<?php

namespace RandData\Fabric\DataSet;

/**
 * Russian datasets fabric
 */
class StringRu
{
    /**
     * Returns russian datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if ($setInfo->getName() == "ru_city") {
            return new \RandData\Set\ru_RU\City();
        } elseif ($setInfo->getName() == "ru_person") {
            return new \RandData\Set\ru_RU\Person();
        } elseif ($setInfo->getName() == "ru_postcode") {
            return new \RandData\Set\ru_RU\PostCode();
        } elseif ($setInfo->getName() == "ru_street") {
            return new \RandData\Set\ru_RU\Street();
        } elseif ($setInfo->getName() == "ru_address") {
            return new \RandData\Set\ru_RU\Address();
        }
        
        return null;
    }
}
