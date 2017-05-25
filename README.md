# RandData
Data generator with support for complex data and dependency realization

## Installation

## Basic usage

More examples in src/examples folder

### Raw random values

```php
$dataSetInteger = $fabric->createObjectFromString("integer");
for ($i = 1; $i <= 10; $i++) {
    $dataSetInteger->get();
}

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
// ...
$dataSetInteger3 = $fabric->createObjectFromString("integer:min=111;max=222");
// ...
```

### Filling database

TBD

### Filling string by template

TBD

### Filling forms

TBD

## Main Objects 

### RandDataSet

Atomic piece of data, may be simple (boolean, number or char) or complex, for 
example *PersonName* Object (FirstName + MiddleName + LastName) or *AviaTicket Order* Object 
(departure information, route, passenger list, status information and so on)

### RandDataGenerator

Just manages generation process

### RandDataFabric

Creates RandDataSet objects 


