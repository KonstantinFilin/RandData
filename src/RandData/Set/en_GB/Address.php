<?php

namespace RandData\Set\en_GB;

/**
 * UK address dataset
 */
class Address extends \RandData\Set
{
    /**
     * @inherit
     */
    public function get() {
        $flatSuffixList = [ "a", "b", "c", "d", "e", "f" ];
        $randSet1 = new Postcode();
        $postcode = $randSet1->get();
        $randSet2 = new City($postcode);
        $randSet3 = new Street();
        $street = $randSet3->get();
        $flat = rand(1, 500);
        
        if (mt_rand(1, 100) > 50) {
            $flat .= $flatSuffixList[array_rand($flatSuffixList)];
        }
        
        $ret = [
            $flat . " " . $street,
            $randSet2->get(),
            $postcode
        ];
        
        return implode(", ", $ret);
    }

    /**
     * @inherit
     */
    public function init($params = []) {
        
    }
}
