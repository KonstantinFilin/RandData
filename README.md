# RandData
Data generator with support for complex data and dependency realization

## Main Objects 

### RandDataSet

Atomic piece of data, may be simple (boolean, number or char) or complex, for 
example *PersonName* Object (FirstName + MiddleName + LastName) or *AviaTicket Order* Object 
(departure information, route, passenger list, status information and so on)

### RandDataGenerator

Just manages generation process

### RandDataFabric

Creates RandDataSet objects 