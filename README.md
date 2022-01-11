# Proof of Concept to provide a Command-Bus pattern approach and Use Cases based architecture in Magento.
## This extension intends to create an example of how we can use a different approach to Services in Magento in order to simplify the consumption of such services.

[![GPLv3 License](https://img.shields.io/badge/license-GPLv3-marble.svg)](https://www.gnu.org/licenses/gpl-3.0.en.html)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ticaje/m2-command-bus.svg?style=flat-square)](https://packagist.org/packages/ticaje/m2-command-bus)
[![Total Downloads](https://img.shields.io/packagist/dt/ticaje/m2-command-bus.svg?style=flat-square)](https://packagist.org/packages/ticaje/m2-command-bus)
[![Blog](https://img.shields.io/badge/Blog-hectorbarrientos.com-magenta)](https://hectorbarrientos.com)

## Preface

This extension is a practical example to the Command-bus design pattern within Magento context.
Normally, when we have services in our custom solutions, we instantiate those services in our consumer classes and call public methods defined in service contracts.

This approach has various setbacks:

1. Stateless nature based service violation.

Very often when creating services we end up jeopardizing services themselves by introducing infrastructure related concerns within a service class.
The most commonly example of this violation are:

a) Using session related modules within services. This ties up a service to specific context that is mostly, a web based context.
b) Using framework specific managing classes within services. An example could be instantiating Store manager within a service class.

Any of the previous examples bring up the inconvenient of having to modify the service class if we want to run it from a new context like a cli command based application or a Cron component.


2. API service contracts violation.

On this regard, there is the possibility of adding a lot of arguments to public signatures in order to comply with service needs.
An API is the looking glass of a service to the world, so, the less the arguments its signatures have the more consistent the API will become.
The idea is to create a defined by contract object in front of API boundaries to pass values needed by services to its functionality.
The answer to this requirement are DTOs.


## Installation

You can install this package using composer(the only way i recommend)

```bash
composer require ticaje/m2-command-bus
```

## Quick Explanation.

The command bus pattern consists of few components to simplify service consumption and maintenance.

Command
=======

A command is basically a DTO that corresponds to a well defined service contract to provide needed input data to services.

Handler
=======

A handler is the context where the service logic is placed, whether as an external dependency or just the reservoir of the logic itself.

Bus
===

The bus is what connects Commands to Handlers, it's therefore the facade of services to consumers.
The consumer instantiates a bus, instantiates a specific command, sets proper data into it and passes it to bus's public signature, normally it is handle/execute method.

In our case we are gonna use a library called Tactician which offers really useful coverage for Command-bus pattern.

## Bibliography

https://matthiasnoback.nl/2015/01/responsibilities-of-the-command-bus/
https://refactoring.guru/design-patterns/command/php/example
https://tactician.thephpleague.com/

## Credits

- [Héctor Luis Barrientos](https://github.com/ticaje)
- [All Contributors](../../contributors)

## License

The GNU General Public License (GPLv3). Please see [License File](LICENSE.md) for more information.
