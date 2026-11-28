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

namespace Ergebnis\DataGenerator\Test\Unit\Exception;

use Ergebnis\DataGenerator;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(DataGenerator\Exception\InvalidGeneratorsException::class)]
final class InvalidGeneratorsExceptionTest extends Framework\TestCase
{
    public function testEmptyReturnsException(): void
    {
        $exception = DataGenerator\Exception\InvalidGeneratorsException::empty();

        $message = 'Generators can not be empty.';

        self::assertSame($message, $exception->getMessage());
    }
}
