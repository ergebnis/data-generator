<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017-2023 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/data-generator
 */

namespace Ergebnis\DataGenerator\Test\Unit;

use Ergebnis\DataGenerator\Example;
use Ergebnis\DataGenerator\Test;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(Example::class)]
final class ExampleTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testFromStringReturnsExample(): void
    {
        $value = self::faker()->sentence();

        $example = Example::fromString($value);

        self::assertSame($value, $example->toString());
    }
}
