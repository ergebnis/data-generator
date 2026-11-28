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

#[Framework\Attributes\CoversClass(DataGenerator\ConcatenatingValueGenerator::class)]
#[Framework\Attributes\UsesClass(DataGenerator\Exception\InvalidGeneratorsException::class)]
#[Framework\Attributes\UsesClass(DataGenerator\ValueGenerator::class)]
final class ConcatenatingValueGeneratorTest extends Framework\TestCase
{
    use DataGenerator\Test\Util\Helper;

    public function testConstructorRejectsEmptyGenerators(): void
    {
        $this->expectException(DataGenerator\Exception\InvalidGeneratorsException::class);

        new DataGenerator\ConcatenatingValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromOneGenerator(): void
    {
        $values = self::faker()->words();

        $generator = new DataGenerator\ConcatenatingValueGenerator(new DataGenerator\ValueGenerator(...$values));

        $generated = \iterator_to_array($generator->generate());

        self::assertSame($values, $generated);
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromTwoGenerators(): void
    {
        $generator = new DataGenerator\ConcatenatingValueGenerator(
            new DataGenerator\ValueGenerator(
                'foo',
                'bar',
            ),
            new DataGenerator\ValueGenerator(
                '1',
                '2',
                '3',
            ),
        );

        $generated = \iterator_to_array($generator->generate());

        $expected = [
            'foo1',
            'foo2',
            'foo3',
            'bar1',
            'bar2',
            'bar3',
        ];

        self::assertSame($expected, $generated);
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromThreeGenerators(): void
    {
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

        $generated = \iterator_to_array($generator->generate());

        $expected = [
            'foo-qux',
            'foo-quux',
            'bar-qux',
            'bar-quux',
            'baz-qux',
            'baz-quux',
        ];

        self::assertSame($expected, $generated);
    }
}
