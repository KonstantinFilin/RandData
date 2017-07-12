<?php

require "../init.php";

class CarTuple extends \RandData\Tuple 
{
    public function getDataSets() {
        return [
            "mark" => "string_list:values=ford,bmw,audi,vw,skoda,toyota,volvo,mercedez,bently,saab",
            "color" => "string_list:values=white,black,grey,blue,yellow,green,orange,red",
            "year" => "integer:min=1950;max=2017"
        ];
    }
}

class PersonTuple2 extends \RandData\Tuple {

    public function getDataSets() {
        return [
            "name" => "en_person",
            "birth" => "date:min=1920-01-01;max=1999-12-31",
            "login" => "string:char_list=abcdefghjklmnopqrstuvwxyz0123456789;length_min=2;length_max=8",
            "car" => new CarTuple()
        ];
    }
    
    protected function getNullProbability() {
        return [
            "car" => 30
        ];
    }
}

class OrderTuple extends \RandData\Tuple {
    protected $personList;
    
    function __construct($personList) {
        parent::__construct();
        $this->personList = $personList;
    }
    
    public function getDataSets() {
        return [
            "num" => "complex:template=id{string:char_list=abcdef;length_min=2;length_max=2}/" . date("Ymd") . "/{integer:min=1000;max=9999}",
            "delivery_address" => "en_address",
            "price" => "integer:min=50;max=1000",
            "person" => "value:value=person"
        ];
    }
    
    protected function getSetValueOrNull(RandData\Set $set, $fldName) {
        if ($fldName == "person") {
            return $this->personList[array_rand($this->personList)];
        } 
        
        return $set->get();
    }
}

$generator = new \RandData\Generator(new PersonTuple2(), 3);
$personList = $generator->run();
$ot = new OrderTuple($personList);

$generator2 = new \RandData\Generator($ot, 5);
$orderList = $generator2->run();

var_dump($generator2->run()); 
echo PHP_EOL;
