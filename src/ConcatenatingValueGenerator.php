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

namespace Ergebnis\DataGenerator;

final class ConcatenatingValueGenerator implements StringGenerator
{
    private readonly StringGenerator $firstGenerator;
    private readonly StringGenerator $secondGenerator;

    /**
     * @throws Exception\InvalidGeneratorsException
     */
    public function __construct(StringGenerator ...$generators)
    {
        $count = \count($generators);

        if (0 === $count) {
            throw Exception\InvalidGeneratorsException::empty();
        }

        $this->firstGenerator = \array_shift($generators);

        if (1 === $count) {
            $this->secondGenerator = new ValueGenerator('');

            return;
        }

        $this->secondGenerator = new self(...$generators);
    }

    public function generate(): \Generator
    {
        foreach ($this->firstGenerator->generate() as $firstValue) {
            foreach ($this->secondGenerator->generate() as $secondValue) {
                yield $firstValue . $secondValue;
            }
        }
    }
}
