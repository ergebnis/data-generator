<?php

declare(strict_types=1);

/**
 * Copyright (c) 2023 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/data-generator
 */

use Ergebnis\DataGenerator\Exception;
use Ergebnis\DataGenerator\SequentialValueGenerator;
use Ergebnis\DataGenerator\Test;
use Ergebnis\DataGenerator\ValueGenerator;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(SequentialValueGenerator::class)]
#[Framework\Attributes\UsesClass(Exception\InvalidGeneratorsException::class)]
#[Framework\Attributes\UsesClass(ValueGenerator::class)]
final class SequentialValueGeneratorTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testConstructorRejectsEmptyGenerators(): void
    {
        $this->expectException(Exception\InvalidGeneratorsException::class);

        new SequentialValueGenerator();
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromOneGenerator(): void
    {
        $values = self::faker()->words();

        $generator = new SequentialValueGenerator(new ValueGenerator(...$values));

        $generated = \iterator_to_array($generator->generate());

        self::assertSame($values, $generated);
    }

    public function testGenerateReturnsGeneratorThatYieldsValuesFromTwoGenerators(): void
    {
        $generator = new SequentialValueGenerator(
            new ValueGenerator(
                'foo',
                'bar',
                'baz',
            ),
            new ValueGenerator(
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
