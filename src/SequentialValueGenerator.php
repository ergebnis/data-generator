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

final class SequentialValueGenerator implements StringGenerator
{
    /**
     * @var array<StringGenerator>
     */
    private readonly array $generators;

    /**
     * @throws Exception\InvalidGeneratorsException
     */
    public function __construct(StringGenerator ...$generators)
    {
        if ([] === $generators) {
            throw Exception\InvalidGeneratorsException::empty();
        }

        $this->generators = $generators;
    }

    public function generate(): \Generator
    {
        foreach ($this->generators as $generator) {
            foreach ($generator->generate() as $value) {
                yield $value;
            }
        }
    }
}
