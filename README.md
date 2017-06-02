# RandData
Data generator with support for complex data and dependency realization

* [Installation](https://github.com/KonstantinFilin/RandData#installation)
* [Basic usage](https://github.com/KonstantinFilin/RandData#basic-usage)
* [DataSet](https://github.com/KonstantinFilin/RandData#dataset-options)
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

TBA

### Filling database

TBA

### Filling forms

TBA

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

> integer

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

**Initialization string examples**

```
string_list:values=Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday
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

## Main Objects 

### RandDataSet

Atomic piece of data, may be simple (boolean, number or char) or complex, for 
example *PersonName* Object (FirstName + MiddleName + LastName) or *AviaTicket Order* Object 
(departure information, route, passenger list, status information and so on)

### RandDataGenerator

Just manages generation process

### RandDataFabric

Creates RandDataSet objects 

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
* (-) Person
* (-) Address
* (-) Domain
* (-) Email

**And also**

* Object fabric
* Required or NULL
* Possibility of value
* Data dependency (subobjects, date difference and so on)
* Output formats (csv, sql, json)
* Generating datasets from database tables
* Graphic interface
* API documentation
* Class members checking

