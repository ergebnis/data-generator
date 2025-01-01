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

namespace Ergebnis\DataGenerator\Exception;

final class InvalidGeneratorsException extends \InvalidArgumentException
{
    public static function empty(): self
    {
        return new self('Generators can not be empty.');
    }
}
