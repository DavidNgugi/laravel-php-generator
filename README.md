# Laravel PHP Generator

A simple command line tool to generate your Laravel classes, interfaces and traits. Aiming for your higher productivity

<img src ="https://travis-ci.org/DavidNgugi/laravel-php-generator.svg?branch=master">

# Installation

```bash
composer require davidngugi/laravel-php-generator
```

# Documentation

The package allows you to generate Classes, Interfaces and Traits. You can generate classes that extend another class and implements an interface. The package generates the necessary directories as specified by the -p or path option. Otherwise there is a default path used.

All paths lead to the App directory. So don't have App in you path. 

The following subsections explain further how to use the various commands

*NOTE: Replace the string in curly braces with your own values*

<img src ="https://github.com/DavidNgugi/laravel-php-generator/blob/master/code.jpg?raw=true" width="100%" height ="240px">

## Create a class

```bash
php artisan generate:class {class_name_here}
```

### Example
```bash
php artisan generate:class Account
```
this generates the following

```php
<?php

namespace App\Logic;

class Account 
{
    //
}
```

Including the path. E.g Logic/Core

```bash
php artisan generate:class -p {path_here} {class_name_here}
```

You can generate multiple classes at a go

```bash
php artisan generate:class {class1_name_here} {class2_name_here} {class3_name_here}
```

## Create and Extend a class

We use the -e or --extend option. Specify the name of the class to extend. The class to extend will also be generated if it doesn't exist. You can only extend one class

```bash
php artisan generate:class -e {name_of_class_to_extend} {class_name_here}
```
### Example 
```bash
php artisan generate:class -e BankAccount CurrentAccount
```
this generates the following 2 files:
```php
<?php

namespace App\Logic;

class BankAccount
{
    //
}
```
```php
<?php

namespace App\Logic;

use App\Logic\BankAccount;

class CurrentAccount extends BankAccount
{
    //
}
```

## Generate a class and Implement an Interface

We use the -i or --interface option. Specify the name of the interface to implement.

NOTE: *The interface name should be without the word 'Interface' at the end, this will be auto-generated* . 
You can only implement one interface

```bash
php artisan generate:class -i{name_of_interface_to_extend} {class_name_here}
```
### Example: 
```bash
php artisan generate:class -i Finance BankAccount
```

this will generate the following 2 files:

An interface
```php
<?php

namespace App\Logic;

interface FinanceInterface
{
    //
}
```

and a class

```php
<?php

namespace App\Logic;

use App\Logic\FinanceInterface;

class BankAccount implements FinanceInterface
{
    //
}
```

## Create and Extend a class and Implement an Interface 

We use the above options (-e and -i).

```bash
php artisan generate:class -e {name_of_class_to_extend} -i  {class_name_here}
```

### Example
```bash
php artisan generate:class -e BanckAccount -i Finance CurrentAccount
```
this generates
```php
<?php

namespace App\Logic;

use App\Logic\FinanceInterface;
use App\Logic\BankAccount;

class CurrentAccount extends BankAccount implements FinanceInterface
{
    //
}
```
*NOTE:* No existing files or folders will be overwritten by these commands

## Create an Interface 

We use the *generate:interface* artisan command. This also supports the -p or --path option to specify the directory path. 

*App\Logic\Interfaces is the default path*

```bash
php artisan generate:interface {interface_name}
```

### Example
```bash
php artisan generate:interface Finance
```
this generates the following

```php
<?php

namespace App\Logic\Interfaces;

/**
*  FinanceInterface Interface
*/
interface FinanceInterface
{
    //
}
```

## Create a Trait 

We use the *generate:trait* artisan command. This also supports the -p or --path option to specify the directory path. 

*App\Logic\Traits is the default path*

```bash
php artisan generate:trait {trait_name}
```
### Example
```bash
php artisan generate:trait Transactable
```
this generates the following

```php
<?php

namespace App\Logic\Traits;

/**
*  Transactable Trait
*/
trait Transactable 
{
    //
}
```
# Contribution

All contributions (big or small) are highly welcomed. Send a PR

# Authors

* David Ngugi <david@davidngugi.com>

# Support

If you would love to support the continuous development and maintenance of this package, please consider buying me a coffee.

<a href = "https://www.buymeacoffee.com/DavidNgugi" title = "Buy Me a Coffee" target="_blank"><img src="https://github.com/DavidNgugi/laravel-php-generator/blob/master/coffee.jpg?raw=true" width="240px" height ="150px"/></a>

# License

This package is open-sourced software licensed under the [MIT Licence](../blob/master/LICENSE)

