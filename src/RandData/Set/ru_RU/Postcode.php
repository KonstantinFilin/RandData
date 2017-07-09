<?php

namespace RandData\Set\ru_RU;

class Postcode extends \RandData\Set
{
    protected $cityCodeList;
    
    function __construct() {
        $this->cityCodeList = $this->getRussiaCityCodeList();
    }
    
    public function get() {
        $cityCodeList = $this->getCityCodeList();
        $part1 = $cityCodeList[array_rand($cityCodeList)];
        $part2 = mt_rand(0, 999);
        return $part1 . sprintf("%03u", $part2);
    }

    public function init($params = array()) {
        if (!empty($params["city_code_list"])) {
            $this->cityCodeList = $params["city_code_list"];
        }
    }
    
    function getCityCodeList() {
        return $this->cityCodeList;
    }

    protected function getRussiaCityCodeList()
    {
        return array_merge(
            range(101, 135),
            range(140, 144),
            range(150, 157),
            range(160, 175),
            range(180, 188),
            range(190, 199),
            range(214, 216),
            range(236, 238),
            range(241, 243),
            range(248, 249),
            range(295, 303),
            range(305, 309),
            range(344, 347),
            range(350, 369),
            [ 385, 386 ],
            range(390, 404),
            range(410, 416),
            range(420, 433),
            range(440, 446),
            range(450, 457),
            range(460, 462),
            range(600, 607),
            range(610, 636),
            [ 640, 641 ],
            range(644, 694)
        );
    }
}
