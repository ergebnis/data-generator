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

use Ergebnis\DataGenerator\ConcatenatingValueGenerator;
use Ergebnis\DataGenerator\Exception;
use Ergebnis\DataGenerator\Test;
use Ergebnis\DataGenerator\ValueGenerator;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(ConcatenatingValueGenerator::class)]
#[Framework\Attributes\UsesClass(Exception\InvalidGeneratorsException::class)]
#[Framework\Attributes\UsesClass(ValueGenerator::class)]
final class ConcatenatingValueGeneratorTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testConstructorRejectsEmptyGenerators(): void
    {
        $this->expectException(Exception\InvalidGeneratorsException::class);

        new ConcatenatingValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromOneGenerator(): void
    {
        $values = self::faker()->words();

        $generator = new ConcatenatingValueGenerator(new ValueGenerator(...$values));

        $generated = \iterator_to_array($generator->generate());

        self::assertSame($values, $generated);
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromTwoGenerators(): void
    {
        $generator = new ConcatenatingValueGenerator(
            new ValueGenerator(
                'foo',
                'bar',
            ),
            new ValueGenerator(
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
        $generator = new ConcatenatingValueGenerator(
            new ValueGenerator(
                'foo',
                'bar',
                'baz',
            ),
            new ValueGenerator('-'),
            new ValueGenerator(
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
