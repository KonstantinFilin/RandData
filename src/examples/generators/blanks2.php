<?php

require "../init.php";

class BlankTuple extends \RandData\Tuple
{
    public function getDataSets()
    {
        return [
            "name" => "string_list:values=John,Paul,George,Ringo",
            "dt" => "date:min=1962-10-05;max=1970-05-08",
            "age" => "integer:min=19;max=30"
        ];
    }
    
    protected function getValue(\RandData\Set $set, $fldName)
    {
        $birthDtList = [
            "John" => "1940-10-09",
            "Paul" => "1942-06-18",
            "George" => "1943-02-25",
            "Ringo" => "1940-07-07"
        ];

        if ($fldName == "age") {
            $name = $this->result["name"];
            $dtCreated = new \DateTime($this->result["dt"]);
            $birth = !empty($birthDtList[$name])
                ? new \Datetime($birthDtList[$name])
                : null;
            
            if ($dtCreated && $birth) {
                $interval = $birth->diff($dtCreated);
                return $interval->format("%y");
            }
            
            return 0;
        }
        
        return $set->get();
    }
}

$generator = new RandData\BlankGenerator(new BlankTuple);
$tpl = "Hello, I'm {name}, my age {age} and today is {dt}. {name} at {dt}";
$generator->init($tpl);
echo $generator->run() . PHP_EOL;
