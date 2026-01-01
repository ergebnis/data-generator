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

use Ergebnis\DataGenerator\Exception;
use Ergebnis\DataGenerator\OptionalValueGenerator;
use Ergebnis\DataGenerator\Test;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(OptionalValueGenerator::class)]
#[Framework\Attributes\UsesClass(Exception\InvalidValuesException::class)]
final class OptionalValueGeneratorTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testConstructorRejectsEmptyValues(): void
    {
        $this->expectException(Exception\InvalidValuesException::class);

        new OptionalValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValues(): void
    {
        $values = self::faker()->words();

        $generator = new OptionalValueGenerator(...$values);

        $generated = \iterator_to_array($generator->generate());

        $expected = \array_merge(
            [
                '',
            ],
            $values,
        );

        self::assertSame($expected, $generated);
    }
}
