# About this application

Het "orders" component is ontwikkeld voor de gemeente Utrecht en heeft als doel het verwerken van bestellingen. Dit component gaat vaak hand in hand met de componenten betalen en producten en diensten maar dit is niet altijd noodzakelijk.

## Documentation

- [Installation manual](https://github.com/ConductionNL/orderscomponent/blob/master/INSTALLATION.md).
- [contributing](https://github.com/ConductionNL/orderscomponent/blob/master/CONTRIBUTING.md) for tips tricks and general rules concerning contributing to this component.
- [codebase](https://github.com/ConductionNL/orderscomponent) on github.
- [codebase](https://github.com/ConductionNL/orderscomponent/archive/master.zip) as a download.
- [Design considerations](DESIGN-PDC.md)
- [Data model](api/public/schema/datamodel.pdf)
- [Postman tests](api/public/schema/pdc.postman_collection.json)

Getting started
-------
Do you want to create your own Commonground component? Take a look at our in depht [tutorial](TUTORIAL.md) on spinning up your own component!

The commonground bundle
-------
This repository uses the power of conduction's [commonground bundle](https://packagist.org/packages/conduction/commongroundbundle) for symfony to provide common ground specific functionality based on the [VNG Api Strategie](https://docs.geostandaarden.nl/api/API-Strategie/). Including  

* Build in support for public APIs like BAG (Kadaster), KVK (Kamer van Koophandel)
* Build in validators for common dutch variables like BSN (Burger service nummer), RSIN(), KVK(), BTW()
* AVG and VNG proof audit trails
* And [much more](https://packagist.org/packages/conduction/commongroundbundle) .... 

Be sure to read our [design considerations](/design.md) concerning the [VNG Api Strategie](https://docs.geostandaarden.nl/api/API-Strategie/). 


Requesting features
-------
Do you need a feature that is not on this list? don't hesitate to send us a [feature request](https://github.com/ConductionNL/commonground-component/issues/new?assignees=&labels=&template=feature_request.md&title=).  

Staying up to date
-------

## Features
This repository uses the power of the [commonground proto component](https://github.com/ConductionNL/commonground-component) provide common ground specific functionality based on the [VNG Api Strategie](https://docs.geostandaarden.nl/api/API-Strategie/). Including  

* Build in support for public APIs like BAG (Kadaster), KVK (Kamer van Koophandel)
* Build in validators for common dutch variables like BSN (Burger service nummer), RSIN(), KVK(), BTW()
* AVG and VNG proof audit trails, Wildcard searches, handling of incomplete date's and underInvestigation objects
* Support for NLX headers
* And [much more](https://github.com/ConductionNL/commonground-component) .... 

## License

Copyright &copy; [Gemeente Utrecht](https://www.utrecht.nl/)  2019 

Licensed under [EUPL](https://github.com/ConductionNL/orderscomponent/blob/master/LICENSE.md)

## Credits

[![Utrecht](https://raw.githubusercontent.com/ConductionNL/orderscomponent/master/resources/logo-utrecht.svg?sanitize=true "Utrecht")](https://www.utrecht.nl/)
[![Conduction](https://raw.githubusercontent.com/ConductionNL/orderscomponent/master/resources/logo-conduction.svg?sanitize=true "Conduction")](https://www.conduction.nl/)



