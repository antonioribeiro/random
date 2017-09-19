# Random

[![Latest Stable Version](https://img.shields.io/packagist/v/pragmarx/random.svg?style=flat-square)](https://packagist.org/packages/pragmarx/random)
[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://scrutinizer-ci.com/g/antonioribeiro/random/badges/build.png?b=master)](https://scrutinizer-ci.com/g/antonioribeiro/random/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/antonioribeiro/random/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/antonioribeiro/random/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/antonioribeiro/random/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/antonioribeiro/random/?branch=master)
[![StyleCI](https://styleci.io/repos/103568219/shield)](https://styleci.io/repos/103568219)

Generate random strings / numbers

## Features

It can generate:

- Strings
- Numbers (string or integers)
- Prefixed and suffixed random strings
- Hexadecimal
- Patterns ([abcd], [aeiou], [A-Z0123], [0-9a-f])
- Upper, lower and mixed case
- Cryptographically secure random bytes (from `random_bytes()`)

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
$this->random->numeric()->size(3);
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

#### Disable character filter 

Usually the package returns characters in the range of Base64 (A to Z, a to z and 0 to 9), but you can disable this and make it return whatever random_bytes returns: 

``` php
$this->random->noPattern()->get();
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
