# RandData
Data generator with support for complex data and dependency realization

* [Installation](https://github.com/KonstantinFilin/RandData#installation)
* [Basic usage](https://github.com/KonstantinFilin/RandData#basic-usage)
    * [Raw random values example](https://github.com/KonstantinFilin/RandData#raw-random-values-example)
    * [Filling string by template](https://github.com/KonstantinFilin/RandData#filling-string-by-template)
    * [Generators. Creating csv](https://github.com/KonstantinFilin/RandData#generators-creating-csv)
    * [Generators. Filling database and more](https://github.com/KonstantinFilin/RandData#generators-filling-database-and-more)
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
    
    // Age field is dependant from dt field. See Data dependency
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
* (-) API documentation
* (-) Class members checking (input values)

* (-) Generating datasets from database tables
* (-) Graphic interface
* (-) Code style, mess detector, code metrics
* (-) CI
