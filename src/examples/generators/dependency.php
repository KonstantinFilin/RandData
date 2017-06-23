<?php

require "../init.php";

class EmployeeTuple extends \RandData\Tuple {
    
    const LEVEL_1 = 40*365*24*3600;
    const LEVEL_2 = 30*365*24*3600;
    const HIRED_AGE_MIN = 20*365*24*3600;
    const HIRED_AGE_MAX = 50*365*24*3600;
    
    public function getDataSets() {
        return [
            "sex" => "string_list:values=" . RandData\Set\en_GB\Person::SEX_MALE . "," . RandData\Set\en_GB\Person::SEX_FEMALE,
            "name" => "en_person",
            "birth" => "date:min=now -50 year;max=now -20 year",
            "hired" => "date:min=now -3 year;max=now",
            "fired" => "date:min=now -3 year;max=now",
            "score" => "int:min=1;max=3"
        ];
    }
    
    protected function getNullProbability() {
        return [
            "fired" => 30
        ];
    }
    
    protected function getValue(RandData\Set $set, $fldName)
    {
        $value = parent::getValue($set, $fldName);
        
        // Override dependent datasets
        if ($fldName == "sex") {
            $this->getValueSex($value);
        } elseif ($fldName == "birth") {
            $this->getValueBirth($value);
        } elseif ($fldName == "hired") {
            $this->getValueHired($value);
        }
        
        return $value;
    }
    
    private function getValueSex(&$value) {
        $this->datasets["name"] = "en_person:sex=" . $value;
        $value = $value == RandData\Set\en_GB\Person::SEX_MALE ? "Male" : "Female";
    }
    
    private function getValueHired($value) {
        // Fired date must be later than hired date, 
        // but earlier than today
        $hiredTs = date("U", strtotime($value));
        $firedDtMin = date("Y-m-d", $hiredTs + 1*24*3600);
        $firedDtMax = date("Y-m-d", date("U") - 3*24*3600);
        $this->datasets["fired"] = "date:min=" . $firedDtMin . ";max=" .$firedDtMax ;
    }
    
    private function getValueBirth($value) {
        $birthTs = date("U", strtotime($value));
        $nowTs = date("U");
        
        // Hired date must be later than birth date
        // Let's we can hire somebody in the ages from 20 to 50
        $hiredTsMin = date("Y-m-d", date("U", min([ $birthTs + self::HIRED_AGE_MIN, date("U") ])));
        $hiredTsMax = date("Y-m-d", date("U", min([ $birthTs + self::HIRED_AGE_MAX, date("U") ])));
        $this->datasets["hired"] = "date:min=" . $hiredTsMin . ";max=" . $hiredTsMax;

        // Let's some dummy score will be dependant on age
        if (self::LEVEL_1 < $nowTs - $birthTs) {
            $this->datasets["score"] = "int:min=20;max=25";
        } elseif (self::LEVEL_2 < $nowTs - $birthTs) {
            $this->datasets["score"] = "int:min=10;max=13";
        }
    }
}

$employeeTuple = new EmployeeTuple();
$generator = new \RandData\Generator($employeeTuple, 50);
$formatter = new \RandData\Formatter\Csv($generator);

echo $formatter->build() . PHP_EOL;
