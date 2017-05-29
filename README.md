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

**Initialization string example**

```
boolean
```

```
boolean:valTrue=1;valFalse=0
```

```
boolean:valTrue=true;valFalse=false
```

### Integer

**ID**

> integer

**Params**

* min: Minimum value (default to 0)
* max: Maximum value (default to return value of [getrandmax()](http://php.net/manual/en/function.getrandmax.php) PHP function

**Initialization string example**

```
integer
```
```
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

**Initialization string example**

```
float:min=8;max=13
```

```
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

**Initialization string example**

```
string:length_min=4;length_max=4;char_list=abc
string:length_min=3;length_max=7;char_list=abcdefghijklmnoprstuvwxyz
string:length_min=3;length_max=5;char_list=ABCDEF0123456789
```

### String List

One random string from the list

**ID**

> string_list

**Params**

* values: Comma seperated list of available values

**Initialization string example**

```
string_list:values=Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday
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
* (-) Word
* (-) Paragraph
* (-) Date
* (-) Time
* (-) Datetime
* (-) Phone
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

