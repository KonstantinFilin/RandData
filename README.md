# RandData
Data generator with support for complex data and dependency realization

* [Installation](https://github.com/KonstantinFilin/RandData#installation)
* [Basic usage](https://github.com/KonstantinFilin/RandData#basic-usage)
    * [Raw random values example](https://github.com/KonstantinFilin/RandData#raw-random-values-example)
    * [Filling string by template](https://github.com/KonstantinFilin/RandData#filling-string-by-template)
    * [Generators. Creating csv](https://github.com/KonstantinFilin/RandData#generators-creating-csv)
    * [Generators. Filling database and more](https://github.com/KonstantinFilin/RandData#generators-filling-database-and-more)
    * [Data dependency](https://github.com/KonstantinFilin/RandData#data-dependency)
    * [Filling forms](https://github.com/KonstantinFilin/RandData#filling-forms)
* [Main Objects](https://github.com/KonstantinFilin/RandData#main-objects) 
    * [RandData Fabric](https://github.com/KonstantinFilin/RandData#randdata-fabric)
    * [RandData Set](https://github.com/KonstantinFilin/RandData#randdata-set)
    * [Tuple](https://github.com/KonstantinFilin/RandData#tuple)
    * [RandData Generator](https://github.com/KonstantinFilin/RandData#randdata-generator)
* [DataSet](https://github.com/KonstantinFilin/RandData#dataset-options)
    * [Counter](https://github.com/KonstantinFilin/RandData#counter)
    * [Boolean](https://github.com/KonstantinFilin/RandData#boolean)
    * [Integer](https://github.com/KonstantinFilin/RandData#integer)
    * [Float](https://github.com/KonstantinFilin/RandData#float)
    * [String](https://github.com/KonstantinFilin/RandData#string)
    * [String List](https://github.com/KonstantinFilin/RandData#string-list)
    * [Paragraph](https://github.com/KonstantinFilin/RandData#paragraph)
    * [Time](https://github.com/KonstantinFilin/RandData#time)
    * [Date](https://github.com/KonstantinFilin/RandData#date)
    * [Datetime](https://github.com/KonstantinFilin/RandData#datetime)
    * [Phone](https://github.com/KonstantinFilin/RandData#phone)
    * [Domain](https://github.com/KonstantinFilin/RandData#domain)
    * [Email](https://github.com/KonstantinFilin/RandData#email)
* [DataSet (ru_RU)](https://github.com/KonstantinFilin/RandData#dataset-ru_ru)
    * [Person](https://github.com/KonstantinFilin/RandData#person)
* [ToDo](https://github.com/KonstantinFilin/RandData#todo)

**Under development**

## Installation

## Basic usage

More examples in src/examples folder

### Raw random values example

```php
$fabric = new RandData\Fabric();
$dataSetInteger = $fabric->createObjectFromString("integer");
for ($i = 1; $i <= 5; $i++) {
    echo $dataSetInteger->get() . PHP_EOL;
}

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
$dataSetInteger3 = $fabric->createObjectFromString("integer:min=111;max=222");
```

### Filling string by template

```php
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
    
    // Age field is dependant from dt field. See [Data dependency]
    protected function getValue(\RandData\Set $set, $fldName) {
        $birthDtList = [
            "John" => "1940-10-09",
            "Paul" => "1942-06-18",
            "George" => "1943-02-25",
            "Ringo" => "1940-07-07"
        ];

        if ($fldName == "age") {            
            $name = $this->result["name"];
            $dt = new \DateTime($this->result["dt"]);
            $birth = !empty($birthDtList[$name]) 
                ? new \Datetime($birthDtList[$name])
                : null;
            
            if ($dt && $birth) {
                $interval = $birth->diff($dt);
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
// Hello, I'm John, my age 27 and today is 1968-07-08. John at 1968-07-08
// Hello, I'm Paul, my age 21 and today is 1963-11-14. Paul at 1963-11-14
// Hello, I'm George, my age 24 and today is 1967-08-14. George at 1967-08-14
// Hello, I'm Ringo, my age 28 and today is 1969-07-05. Ringo at 1969-07-05
// ...
```

### Generators. Creating csv

```php
class PersonTuple extends \RandData\Tuple
{
    public function getDataSets() {
        return [
            "Id" => "counter",
            "Login" => "counter:template=user_#;start=100",
            "Name" => "ru_person",
            "Birth" => "date:min=1900-01-01;max=2005-12-31",
            "Phone" => "phone:country_list=7;region_list=495,499,915,919,905,903",
            "Sum" => "integer:min=100;max=10000",
            "Class" => "string_list:values=aaa,bbb,ccc;possibility=50,20,30"
        ];
    }
    
    protected function getNullProbability() {
        return [
            "Phone" => 20, // null approximately 20% (every fifth)
            "Sum" => 50, // null approximately 50% (every second) 
        ];
    }
}

$formatter = new RandData\Formatter\Csv(new \RandData\Generator(new PersonTuple(), 20));
$formatter->setShowHeaders(false);
$formatter->setShowCounter(false);

echo $formatter->build();
echo PHP_EOL;


/*
#;Name;Birth;Phone;Sum
1;user_100;Ефремова Лика Александровна;1949-09-27;NA;NA;aaa
2;user_101;Соболева Лолита Евгеньевна;2005-04-07;+7 (903) 194-44-11;NA;aaa
3;user_102;Лаврова Стелла Виталиевна;1921-04-23;+7 (495) 621-76-94;9735;aaa
...
*/
```

### Generators. Filling database and more

First of all, you can define your data manually:

```php
class PersonTuple extends \RandData\Tuple
{
    public function getDataSets() {
        return [
            "Id" => "counter",
            "Login" => "counter:template=user_#;start=100",
            "Name" => "ru_person",
            "Birth" => "date:min=1900-01-01;max=2005-12-31",
            "Phone" => "phone:country_list=7;region_list=495,499,915,919,905,903",
            "Sum" => "integer:min=100;max=10000",
            "Class" => "string_list:values=aaa,bbb,ccc;possibility=50,20,30"
        ];
    }
    
    protected function getNullProbability() {
        return [
            "Phone" => 20, // null approximately 20% (every fifth)
            "Sum" => 50, // null approximately 50% (every second) 
        ];
    }
}

/*
INSERT INTO `clients` (`Id`,`Login`,`Name`,`Birth`,`Phone`,`Sum`,`Class`) VALUES ('1','user_100','Кочетова Дина Михайловна','1937-01-26',NULL,NULL,'aaa');
INSERT INTO `clients` (`Id`,`Login`,`Name`,`Birth`,`Phone`,`Sum`,`Class`) VALUES ('2','user_101','Гаврилов Спартак Филиппович','2004-11-17','+7 (915) 907-88-62','9936','ccc');
INSERT INTO `clients` (`Id`,`Login`,`Name`,`Birth`,`Phone`,`Sum`,`Class`) VALUES ('3','user_102','Карасев Аксён Николаевич','1912-02-06',NULL,NULL,'aaa');
...
*/
```

If your database is too big and you want to get it fast, you can get it from sql
SHOW CREATE TABLE command:

```php

$sql = "CREATE TABLE `user` (
 `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 `login` varchar(100) NOT NULL,
 `role` enum('admin','student') NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `passhash` varchar(50) NOT NULL,
 `blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `activate_code` varchar(100) DEFAULT NULL,
 `activate_dt` date DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";

$tableName = "user";
$tuple = new \RandData\Fabric\Tuple\SqlCreateTable($sql);
$generator = new \RandData\Generator($tuple, 20);
$formatter = new \RandData\Formatter\Sql($generator, $tableName);

echo $formatter->build() . PHP_EOL . PHP_EOL;
foreach ($tuple->getDataSets() as $fldName => $fldDef) {
    echo "'" . $fldName . "' => '" . $fldDef . "'" . PHP_EOL;
}
        
echo PHP_EOL;

/* In output sql insert command: */
INSERT INTO `user` (`id`,`login`,`role`,`name`,`passhash`,`blocked`,`activate_code`,`activate_dt`) VALUES ('1','Xi9ERI','student',NULL,'ZsT1ECLs3BrmgUnWBdjpHpLbHgLExH7sxLFzX5','N','hljwMnafH2pn8tPfwflWSl7MyXtnaMUbehdWvocM5avrFk3e',NULL);
INSERT INTO `user` (`id`,`login`,`role`,`name`,`passhash`,`blocked`,`activate_code`,`activate_dt`) VALUES ('2','hHroxmPFgpDGOMl9yvFDykcAFoZ755P5CGHfZXgA9YNIo','student','Yl3UVeEKxvUysapnddBI9hEr9DeaulWUutMVE0WEdifEoytUdIp2APHPdo6XeWXx3hbfl5ps34sDg4pOto470yzuEXT7fn3VwOZ','BnesLyU43ly6T2bg6KWdii2piBLDhVtcSyie','1','j','2014-07-06');

// ... 

/* And rules for inserting into php class: */

'id' => 'counter',
'login' => 'string:length_min=1;length_max=100',
'role' => 'string_list:values=admin,student',
'name' => 'string:length_min=1;length_max=255',
'passhash' => 'string:length_min=1;length_max=50',
'blocked' => 'boolean:valTrue=1;valFalse=0',
'activate_code' => 'string:length_min=1;length_max=100',
'activate_dt' => 'date:min=1900-01-01;max=2099-12-31',

```

If you want it VERY fast and you don't care much about plausibility, you can fill
all database tables (if any field is NOT NULL, it will be NULL with 
about 50% probability):

```php
$dbhost = "localhost";
$dbname = "test";
$dbuser = "root";
$dbpass = "123";
$dsn = sprintf("mysql:dbname=%s;host=%s", $dbname, $dbhost);

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $rows = $dbh->query("show TABLES", PDO::FETCH_COLUMN, 0);

    foreach ($rows as $tblName) {        
        $rowCountSql = "SELECT count(*) FROM `" . $tblName . "`";
        $rowCountRes = $dbh->query($rowCountSql, PDO::FETCH_COLUMN, 0);
        $rowCount = $rowCountRes->fetch();
        
        if ($rowCount > 0) {
            echo "Non empty table: [" . $tblName . "]. Rows count: " . $rowCount . PHP_EOL;
            die;
        }

        $createSqlRow = "SHOW CREATE TABLE `" . $tblName . "`";
        $createSqlRes = $dbh->query($createSqlRow, PDO::FETCH_COLUMN, 1);
        $sql = $createSqlRes->fetch();
        $tuple = new \RandData\Fabric\Tuple\SqlCreateTable($sql);
        $generator = new \RandData\Generator($tuple, 20);
        $formatter = new \RandData\Formatter\Sql($generator, $tblName);
        $sqlIns = $formatter->build();
        $dbh->exec($sqlIns);
    }
    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

echo PHP_EOL;
```

Currenty only this data types supported (feel free to extand the list 
or make your own contribution to the project):
 
* (tiny|small|medium|big)int 
* decimal
* varchar
* (tiny|medium|long)text
* enum
* set (only one of available values for the row will be generated, 
    i.e. one OR two OR three, but not one,two or one,three
* datetime/date/time/year/year(4)/year(2)

### Data dependency

In real life data is dependant. Birth must be before death, sunrise time before sunset time, 
salary is calculating from worked hours, hourly rate, fines and so on.

This library can generate data dependant from other object attributes (for 
example, hired date dependant from birth date). If you
add little method or two, it can generate data dependant from items of other 
object types (for example, Order can be assigned to the manager from the list)

```php

class EmployeeTuple extends \RandData\Tuple {
    
    const LEVEL_1 = 40*365*24*3600;
    const LEVEL_2 = 30*365*24*3600;
    const HIRED_AGE_MIN = 20*365*24*3600;
    const HIRED_AGE_MAX = 50*365*24*3600;
    
    public function getDataSets() {
        return [
            "sex" => "string_list:values=" . RandData\Set\ru_RU\Person::SEX_MALE . "," . RandData\Set\ru_RU\Person::SEX_FEMALE,
            "name" => "ru_person",
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
        $this->datasets["name"] = "ru_person:sex=" . $value;
        $value = $value == RandData\Set\ru_RU\Person::SEX_MALE ? "Муж" : "Жен";        
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

        // Let's some dummy score will be dependant on age
        if (self::LEVEL_1 < $nowTs - $birthTs) {
            $this->datasets["score"] = "int:min=20;max=25";
        } elseif (self::LEVEL_2 < $nowTs - $birthTs) {
            $this->datasets["score"] = "int:min=10;max=13";
        }
        
        // Hired date must be later than birth date
        // Let's we can hire somebody in the ages from 20 to 50
        $hiredTsMin = date("Y-m-d", date("U", min([ $birthTs + self::HIRED_AGE_MIN, date("U") ])));
        $hiredTsMax = date("Y-m-d", date("U", min([ $birthTs + self::HIRED_AGE_MAX, date("U") ])));
        $this->datasets["hired"] = "date:min=" . $hiredTsMin . ";max=" . $hiredTsMax;
    }
}

$employeeTuple = new EmployeeTuple();
$generator = new \RandData\Generator($employeeTuple, 50);
$formatter = new \RandData\Formatter\Csv($generator);

echo $formatter->build() . PHP_EOL;
```

If you have dependencies between different objects (Authors and Books),
it can be little tricky, but something about this:

```php
$bookTuple->setAuthorIds($authorsIds)
// ... and then choose from this list
```

Or simplier, if you test with 100 authors:

```php
class PersonTuple extends \RandData\Tuple
{
    public function getDataSets() {
        return [
            // ...
            "author_id" => "integer:min=1;max=100",
            // ...
        ];
    }
}
```


### Filling forms

TBA


## Main Objects 

### RandData Fabric

Creates RandDataSet objects 

### RandData Set

Generates one random value. Atomic piece of data, may be simple 
(boolean, number or char) or complex, for 
example *PersonName* Object (FirstName + MiddleName + LastName) 
or *AviaTicket Order* Object 
(departure information, route, passenger list, status information and so on)

### Tuple

Manages list of datasets. Can add dataset from PHP object or from string. Generates
array of random values

### RandData Generator

Manages generation process. Produces amount of random datasets 
(array of arrays of random values). 

### RandData Formatter

Buids data stream into something useful. Now it can be csv file, 
sql INSERT commands or JSON array. 

## DataSet options

All DataSet can be created from string identificator ("boolean", "string", "integer" and so on):

There also may be an optional params:
```
ID:params
```
Params seperated by semicolon and name/value pairs separated by equal sign:

```
ID:key1=value1;key2=value2;key3=value3
```

Value may be an array item, its item seperated by comma:
```
ID:letters:a,b,c;persons:John,Mary,Jane
```

### Counter

Simple counter. Generates number sequence inside string or as number. When 
calling by Generator object, it is incremented automatically. When calling 
direct or by Tuple object, you need to set counter value manually

**ID**

> counter, cnt

**Params**

* tpl, template: When setted, it generates string with counter (for example,
template "user_#" turns to { user_1, user_2, user_3, ... }. When missed, then 
usual unsigned integer will be returned { 1, 2, 3, ... }
* start: Default start value. For example, you set generator's amount property 
to 20, and start counter property setted to 100, then you get values 
{ 100, 101, 102, ..., 119 }

**Initialization string example**

```
counter:template=user_#;start=100
```
### Boolean

**ID**

> boolean

**Params**

* valTrue: String to show when true (examples: 1, Y, Yes, +, ...)
* valFalse: String to show when false (examples: 0, N, No, -, ...)

**Initialization string examples**

```
boolean:valTrue=1;valFalse=0
boolean:valTrue=true;valFalse=false
```

### Integer

**ID**

> int, integer

**Params**

* min: Minimum value (default to 0)
* max: Maximum value (default to return value of [getrandmax()](http://php.net/manual/en/function.getrandmax.php) PHP function

**Initialization string examples**

```
integer
integer:min=-5;max=7
```

### Float

**ID**

> float

**Params**

* min: Minimum value (default to 0)
* max: Maximum value (default to return value of [getrandmax()](http://php.net/manual/en/function.getrandmax.php) PHP function
* minFractionDigits: Minimum digits after the point. Default to 0
* maxFractionDigits: Maximum digits after the point. Default to 8

**Initialization string examples**

```
float:min=8;max=13
float:min=4;max=6;minFractionDigits=2;maxFractionDigits=4
```

### String

A string of selected chars

**ID**

> string

**Params**

* length_min: String length. Defaults to 1. Must be minimum 1
* length_max: String length. Defaults to 10. Must be maximum 100
* char_list: List of chars that random string consists of. Defaults to [A-Za-z0-9]

**Initialization string examples**

```
string:length_min=3;length_max=5;char_list=ABCDEF0123456789
```

### Paragraph

A paragraph of words (random char strings) separated by spaces

**ID**

> paragraph

**Params**

* words_min: Minimum  words in paragraph. Defaults to 3. Must be minimum 1
* words_max: Maximum  words in paragraph. Defaults to 100. Must be maximum 500
* length_min: String length. Defaults to 1. Must be minimum 1
* length_max: String length. Defaults to 10. Must be maximum 100
* char_list: List of chars that random string consists of. Defaults to [A-Za-z0-9]

**Initialization string examples**

```
paragraph:words_min=15;words_max=30
paragraph:words_min=15;words_max=30;length_min=4;length_max=6;char_list=ABCDEF0123456789
```

### String List

String from the list

**ID**

> string_list

**Params**

* values: Comma seperated list of available values
* possibility: The possibility of values (in percents). Must be equal 
to the values count and its sum must be 100. If missing, then all values has
the same possibility. 

**Initialization string examples**

```
string_list:values=Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday
string_list:values=aaa,bbb,ccc;possibility=50,20,30
// aaa will be choosen approximately 50 times from 100
// bbb will be choosen approximately 20 times from 100
// ccc will be choosen approximately 30 times from 100
```

### Time

**ID**

> time

**Params**

* min: Minimum time. Default to "00:00"
* max: Maximum time. Default to "23:59"
* seconds: Whether to show seconds. 1 - show, 0 - hide. Default to 0

**Initialization string examples**

```
time:seconds=1
time:min=12:30;max=13:15
```

### Date

**ID**

> date

**Params**

* min: Minimum date. Default to today minus one month. Input format YYYY-MM-DD.
* max: Maximum date. Default to today. Input format YYYY-MM-DD.
* format: Output format. Understands any format of [date()](http://php.net/manual/en/function.date.php) PHP function. Default to YYYY-MM-DD

**Initialization string examples**

```
date:format=d.m.Y
date:min=2017-12-25;max=2017-12-28
```

### Datetime

**ID**

> datetime

**Params**

* date_min: Minimum date. Default to today minus one month. Input format YYYY-MM-DD.
* date_max: Maximum date. Default to today. Input format YYYY-MM-DD.
* date_format: Output format. Understands any format of [date()](http://php.net/manual/en/function.date.php) PHP function. Default to YYYY-MM-DD
* time_min: Minimum time. Default to "00:00"
* time_max: Maximum time. Default to "23:59"
* seconds: Whether to show seconds. 1 - show, 0 - hide. Default to 1

**Initialization string examples**

```
datetime:date_format=d.m.Y;seconds=0
datetime:date_min=2017-05-17;date_max=2017-05-21;time_min=11:00;time_max=14:30
```

### Phone

**ID**

> phone

**Params**

* country_list: List of available country codes (1-9)
* region_list:  List of available region codes (3 or 4 digits)
* format: Whether to show number formatted as +# (###) ###-##-## 
    or +# (####) ###-### or as 11 digits. 
    1 - formatted (default), 0 - unformatted.

**Initialization string examples**

```
phone:format=0
phone:country_list=3,7;region_list=123,456,7890
```

### Domain

**ID**

Two level www domain

> domain

**Params**

* tld_list: List of available top domain. Default: com,edu,org,net
* char_list_edge: First and last char. Default: abcdefghijklmnoprstuvwxyz0123456789
* char_list: Available characters (except first and last one). Default is 
char_list_edge chars and a hyphen char ("-").
* skip_www: Skip www part of domain. Can be 0 or 1. Default 0

**Initialization string examples**

```
domain:skip_www=1
domain:tld_list=org,net;char_list_edge=01;char_list=abcdef0123456789
```

### Email

**ID**

> email

**Params**

* domain_list: Generate mail only in this domains

**Initialization string example**

```
email:domain_list=gmail.com,yahoo.com,hotmail.com,fbi.gov
```

## DataSet (ru_RU)

### Person

**ID**

> ru_person

**Params**

* sex: List of person's sex. m - Male, f - female. Default to both
* format: First name (f), middle name (m) and last name (l) order. 
    Default to "l f m". f1 - first letter of the first name,
    m1 - first letter of the middle name

**Initialization string examples**

```
ru_person:format=f m l
ru_person:format=l f1. m1.
ru_person:sex=m
```
## TODO ##

**Simple**

* (+) NULL
* (+) Integer
* (+) Float
* (+) Boolean
* (+) StringList
* (+) String

**Complex**
* (+) Paragraph
* (+) Time
* (+) Date
* (+) Datetime
* (+) Phone
* (+) Person
* (+) Domain
* (+) Email

* (-) Address (ru_RU)
* (-) Person (en_GB)
* (-) Address (en_GB)

**And also**

* (+) Object fabric
* (+) Required or NULL
* (+) Possibility of value from the list
* (+) Output formats (csv, sql, json)

* (+) Data dependency (subobjects, date difference and so on)
* (+) API documentation
* (+) Class members checking (input values)

* (+) Generating datasets from database tables (v0.9)
* (-) Graphic interface
    * (-) Blanks
    * (-) Data 
    * (-) Forms
* (-) Code style, mess detector, code metrics (v1.0)
* (-) CI
