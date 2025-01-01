<?php

declare(strict_types=1);

/**
 * Copyright (c) 2023-2025 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/data-generator
 */

namespace Ergebnis\DataGenerator\Test\Unit;

use Ergebnis\DataGenerator\Exception;
use Ergebnis\DataGenerator\Test;
use Ergebnis\DataGenerator\ValueGenerator;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(ValueGenerator::class)]
#[Framework\Attributes\UsesClass(Exception\InvalidValuesException::class)]
final class ValueGeneratorTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testConstructorRejectsEmptyValues(): void
    {
        $this->expectException(Exception\InvalidValuesException::class);

        new ValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValues(): void
    {
        $values = self::faker()->words();

        $generator = new ValueGenerator(...$values);

        $generated = \iterator_to_array($generator->generate());

        self::assertSame($values, $generated);
    }
}
