<?php

namespace RandData\Set\en_GB;

/**
 * UK postcode dataset
 */
class Postcode extends \RandData\Set
{
    const VALIDATE_PATTERN = "(\w\w\d\w|\w\d\w|\w\d|\w\d\d|\w\w\d|\w\w\d\d)\s\d\w\w";
    
    /**
     * @inherit
     */
    public function get()
    {
        return $this->getOutwardCode() . ' ' . $this->getInwardCode();
    }

    /**
     * Returns outward part of postcode
     * @return string Outward part of postcode
     */
    protected function getOutwardCode()
    {
        $postcodeDistrictList = $this->getPostcodeDistrictList();
        return $postcodeDistrictList[array_rand($postcodeDistrictList)];
    }

    /**
     *  Returns inward part of postcode
     * @return string Inward part of postcode
     */
    protected function getInwardCode()
    {
        $postcodeSector = mt_rand(0, 9);
        $stringGenerator = new \RandData\Set\String(2, 2);
        $stringGenerator->setChars("QWERTYUPASDFGHJLZXBN");
        return $postcodeSector . $stringGenerator->get();
    }
    
    /**
     * Returns postcode district list
     * @return array Postcode district list
     */
    protected function getPostcodeDistrictList()
    {
        $reader = new \RandData\CsvReader();
        $fileName = __DIR__ . "/data/postcode_district_list.csv";
        $data = $reader->get($fileName);
        return array_map("trim", $data);
    }
}
