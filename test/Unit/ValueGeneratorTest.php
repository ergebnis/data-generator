<?php

declare(strict_types=1);

/**
 * Copyright (c) 2023-2026 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/data-generator
 */

namespace Ergebnis\DataGenerator\Test\Unit;

use Ergebnis\DataGenerator;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(DataGenerator\ValueGenerator::class)]
#[Framework\Attributes\UsesClass(DataGenerator\Exception\InvalidValuesException::class)]
final class ValueGeneratorTest extends Framework\TestCase
{
    use DataGenerator\Test\Util\Helper;

    public function testConstructorRejectsEmptyValues(): void
    {
        $this->expectException(DataGenerator\Exception\InvalidValuesException::class);

        new DataGenerator\ValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValues(): void
    {
        $values = self::faker()->words();

        $generator = new DataGenerator\ValueGenerator(...$values);

        $generated = \iterator_to_array($generator->generate());

        self::assertSame($values, $generated);
    }
}
