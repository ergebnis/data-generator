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

namespace Ergebnis\DataGenerator;

final class OptionalValueGenerator implements StringGenerator
{
    /**
     * @var list<string>
     */
    private readonly array $values;

    /**
     * @throws Exception\InvalidValuesException
     */
    public function __construct(string ...$values)
    {
        if (0 === \count($values)) {
            throw Exception\InvalidValuesException::empty();
        }

        $this->values = $values;
    }

    public function generate(): \Generator
    {
        yield '';

        foreach ($this->values as $value) {
            yield $value;
        }
    }
}
