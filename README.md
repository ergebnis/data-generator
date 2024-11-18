# data-generator

[![Integrate](https://github.com/ergebnis/data-generator/workflows/Integrate/badge.svg)](https://github.com/ergebnis/data-generator/actions)
[![Merge](https://github.com/ergebnis/data-generator/workflows/Merge/badge.svg)](https://github.com/ergebnis/data-generator/actions)
[![Release](https://github.com/ergebnis/data-generator/workflows/Release/badge.svg)](https://github.com/ergebnis/data-generator/actions)
[![Renew](https://github.com/ergebnis/data-generator/workflows/Renew/badge.svg)](https://github.com/ergebnis/data-generator/actions)

[![Code Coverage](https://codecov.io/gh/ergebnis/data-generator/branch/main/graph/badge.svg)](https://codecov.io/gh/ergebnis/data-generator)

[![Latest Stable Version](https://poser.pugx.org/ergebnis/data-generator/v/stable)](https://packagist.org/packages/ergebnis/data-generator)
[![Total Downloads](https://poser.pugx.org/ergebnis/data-generator/downloads)](https://packagist.org/packages/ergebnis/data-generator)
[![Monthly Downloads](http://poser.pugx.org/ergebnis/data-generator/d/monthly)](https://packagist.org/packages/ergebnis/data-generator)

This project provides a [`composer`](https://getcomposer.org) package with data generators.

## Installation

Run

```sh
composer require ergebnis/data-generator
```

## Usage

This project comes with the following data generators:

- [`Ergebnis\DataGenerator\ConcatenatingValueGenerator`](#concatenatingvaluegenerator)
- [`Ergebnis\DataGenerator\OptionalValueGenerator`](#optionalvaluegenerator)
- [`Ergebnis\DataGenerator\SequentialValueGenerator`](#sequentialvaluegenerator)
- [`Ergebnis\DataGenerator\ValueGenerator`](#valuegenerator)

### `ConcatenatingValueGenerator`

Use the `ConcatenatingValueGenerator` to generate values by concatenating values generated from one or more `StringGenerator`s:

```php
<?php

declare(strict_types=1);

use Ergebnis\DataGenerator;

$generator = new DataGenerator\ConcatenatingValueGenerator(
    new DataGenerator\ValueGenerator(
        'foo',
        'bar',
        'baz',
    ),
    new DataGenerator\ValueGenerator('-'),
    new DataGenerator\ValueGenerator(
        'qux',
        'quux',
    ),
);

foreach ($generator->generate() as $value) {
    echo $value . PHP_EOL
}

// foo-qux
// foo-quux
// bar-qux
// bar-quux
// baz-qux
// baz-quux
```

### `OptionalValueGenerator`

Use the `OptionalValueGenerator` to generate an empty string and one or more values from a list of `string` values:

```php
<?php

declare(strict_types=1);

use Ergebnis\DataGenerator;

$generator = new DataGenerator\OptionalValueGenerator(
    'foo',
    'bar',
    'baz',
);

foreach ($generator->generate() as $value) {
    echo $value . PHP_EOL
}

// empty string
// foo
// bar
// baz
```

### `SequentialValueGenerator`

Use the `SequentialValueGenerator` to generate one or more values from one or more `StringGenerator`s:

```php
<?php

declare(strict_types=1);

use Ergebnis\DataGenerator;

$generator = new DataGenerator\SequentialValueGenerator(
    new DataGenerator\ValueGenerator(
        'foo',
        'bar',
        'baz',
    ),
    new DataGenerator\ValueGenerator(
      'qux',
      'quux',
    ),
);

foreach ($generator->generate() as $value) {
    echo $value . PHP_EOL
}

// foo
// bar
// baz
// qux
// quux
```

### `ValueGenerator`

Use the `ValueGenerator` to generate one or more values from a list of `string` values:

```php
<?php

declare(strict_types=1);

use Ergebnis\DataGenerator;

$generator = new DataGenerator\ValueGenerator(
    'foo',
    'bar',
    'baz',
);

foreach ($generator->generate() as $value) {
    echo $value . PHP_EOL
}

// foo
// bar
// baz
```

## Changelog

The maintainers of this project record notable changes to this project in a [changelog](CHANGELOG.md).

## Contributing

The maintainers of this project suggest following the [contribution guide](.github/CONTRIBUTING.md).

## Code of Conduct

The maintainers of this project ask contributors to follow the [code of conduct](https://github.com/ergebnis/.github/blob/main/CODE_OF_CONDUCT.md).

## General Support Policy

The maintainers of this project provide limited support.

You can support the maintenance of this project by [sponsoring @localheinz](https://github.com/sponsors/localheinz) or [requesting an invoice for services related to this project](mailto:am@localheinz.com?subject=ergebnis/data-generator:%20Requesting%20invoice%20for%20services).

## PHP Version Support Policy

This project supports PHP versions with [active and security support](https://www.php.net/supported-versions.php).

The maintainers of this project add support for a PHP version following its initial release and drop support for a PHP version when it has reached the end of security support.

## Security Policy

This project has a [security policy](.github/SECURITY.md).

## License

This project uses the [MIT license](LICENSE.md).

## Social

Follow [@localheinz](https://twitter.com/intent/follow?screen_name=localheinz) and [@ergebnis](https://twitter.com/intent/follow?screen_name=ergebnis) on Twitter.
