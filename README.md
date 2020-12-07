# 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bndwgn/bandwagon.svg?style=flat-square)](https://packagist.org/packages/bndwgn/bandwagon)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/bndwgn/bandwagon/run-tests?label=tests)](https://github.com/bndwgn/bandwagon/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/bndwgn/bandwagon.svg?style=flat-square)](https://packagist.org/packages/bndwgn/bandwagon)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require bndwgn/bandwagon
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Bndwgn\Bandwagon\BandwagonServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Bndwgn\Bandwagon\BandwagonServiceProvider" --tag="config"
```

## Usage

``` php
$bandwagon = new Bndwgn\Bandwagon();
echo $bandwagon->echoPhrase('Hello, Bndwgn!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alex Harris](https://github.com/chasenyc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
