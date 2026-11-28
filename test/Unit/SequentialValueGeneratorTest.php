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

use Ergebnis\DataGenerator;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(DataGenerator\SequentialValueGenerator::class)]
#[Framework\Attributes\UsesClass(DataGenerator\Exception\InvalidGeneratorsException::class)]
#[Framework\Attributes\UsesClass(DataGenerator\ValueGenerator::class)]
final class SequentialValueGeneratorTest extends Framework\TestCase
{
    use DataGenerator\Test\Util\Helper;

    public function testConstructorRejectsEmptyGenerators(): void
    {
        $this->expectException(DataGenerator\Exception\InvalidGeneratorsException::class);

        new DataGenerator\SequentialValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromOneGenerator(): void
    {
        $values = self::faker()->words();

        $generator = new DataGenerator\SequentialValueGenerator(new DataGenerator\ValueGenerator(...$values));

        $generated = \iterator_to_array($generator->generate());

        self::assertSame($values, $generated);
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromTwoGenerators(): void
    {
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

        $generated = \iterator_to_array($generator->generate());

        $expected = [
            'foo',
            'bar',
            'baz',
            'qux',
            'quux',
        ];

        self::assertSame($expected, $generated);
    }
}
