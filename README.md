# Random

[![Latest Stable Version](https://img.shields.io/packagist/v/pragmarx/random.svg?style=flat-square&update=123)](https://packagist.org/packages/pragmarx/random)
[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://img.shields.io/scrutinizer/build/g/antonioribeiro/random.svg?style=flat-square)](https://scrutinizer-ci.com/g/antonioribeiro/random/build-status/master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/antonioribeiro/random.svg?style=flat-square)](https://scrutinizer-ci.com/g/antonioribeiro/random/?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/antonioribeiro/random.svg?style=flat-square)](https://scrutinizer-ci.com/g/antonioribeiro/random/?branch=master)
[![StyleCI](https://styleci.io/repos/103568219/shield)](https://styleci.io/repos/103996703)

#### Generate random strings, numbers, bytes, patterns, and a lot more

## Features

It generates cryptographically secure **pseudo-random** bytes (using `random_bytes()` and `random_int()`) to make:

- Strings
- Numbers (strings or integers)
- Upper, lower and mixed case
- Prefixed and suffixed random strings
- Hexadecimal
- Regex patterns ([abcd], [aeiou], [A-Z0123], [0-9a-f])
- Raw strings, giving you whatever `random_bytes()` generates

#### Faker

If you have [Faker](https://github.com/fzaninotto/Faker) installed it falls back to it, giving you access to random names, dates, cities, phones, and a lot more.

## Install

Via Composer

``` bash
$ composer require pragmarx/random
```

## Usage

#### Basic array usage

``` php
$this->random = new PragmaRX\Random\Random();

$this->random->get(); /// will generate an alpha string which is the same of

$this->random->alpha()->get();
```

Should give you 16 chars (default size) string 

``` text
   Ajv3ejknLmqwC36z
```

#### Defining the size

``` php
$this->random->size(32)->get();
```

#### Upper and lower case

``` php
$this->random->uppercase()->get();
$this->random->lowercase()->size(255)->get();
```

To get back to mixed case you can just:

``` php
$this->random->mixedcase()->get();
```

#### Defining a pattern

The pattern method uses regex, so you can:

``` php
$this->random->pattern('[abcd]')->get();

$this->random->pattern('[A-F0-9]')->get(); /// Hexadecimal
```

To get

``` text
   abcddcbabbacbbdabbcb
```

#### Numeric and Integer 

The pattern method uses regex, so you can:

``` php
$this->random->numeric()->start(10)->end(20)->get();
```

To get

``` text
   (int) 18
```

But if you set the size 

``` php
$this->random->numeric()->size(3)->get();
```

You'll get a string

``` text
   (string) 123
```

#### Hexadecimal 

``` php
$this->random->hex()->size(10)->get();
```

Hexadecimal is uppercase by default, but you can get a lowercase by doing:

``` php
$this->random->hex()->lowercase()->get();
```

#### Prefix && Suffix 

``` php
$this->random->hex()->prefix('#')->size(6)->lowercase()->get();
```

And you should get a random CSS color: 

``` text
#fafafa
```

Of course, the same works for suffixes 

``` php
$this->random->prefix('!')->suffix('@')->get();
```

#### Trivia

There are currently 43982 questions in the trivia database, and this is how you get them:

``` php
$this->random->trivia()->get();

$this->random->trivia()->count(2)->get();
```

You'll need to install the Trivia database package:

``` bash
$ composer require pragmarx/trivia
```

#### Faker

If you install Faker

``` bash
composer require fzaninotto/faker
```
   
You'll also have access to all of the Faker features, like:
   
``` php
$this->random->city()->get();
```

And also use all other features of Random
   
``` php
$this->random->prefix('city: ')->city()->lowercase()->get();
```

You can also change the faker class, you another one pleases you more:

``` php
$this->random->fakerClass(AnotherFaker\Factory::class)->date()->get();
```

#### Raw strings

Usually the package returns characters in the range of Base64 (A to Z, a to z and 0 to 9), but you can completely disable this feature and make it return whatever `random_bytes()` generates: 

``` php
$this->random->raw()->get();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer update
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email acr@antoniocarlosribeiro.com instead of using the issue tracker.

## Credits

- [Antonio Carlos Ribeiro][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[ico-version]: https://img.shields.io/packagist/v/pragmarx/recovery.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pragmarx/recovery/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/pragmarx/recovery.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/pragmarx/recovery.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pragmarx/recovery.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pragmarx/recovery
[link-travis]: https://travis-ci.org/pragmarx/recovery
[link-scrutinizer]: https://scrutinizer-ci.com/g/pragmarx/recovery/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/pragmarx/recovery
[link-downloads]: https://packagist.org/packages/pragmarx/recovery
[link-author]: https://github.com/antonioribeiro
[link-contributors]: ../../contributors
