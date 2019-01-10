<?php
/**
 * {@see https://github.com/zee/ Zee Project (c)}
 */

declare(strict_types=1);

namespace Zee\Errors\Tests;

use Zee\Errors\Error;

final class ErrorTest extends TestCase
{
    /**
     * @test
     */
    public function errorContainsMessageAndItsContextData(): Error
    {
        $error = new Error('Something went wrong', ['foo' => 'bar']);

        self::assertSame('Something went wrong', $error->getMessage());
        self::assertSame(['foo' => 'bar'], $error->getContext());

        return $error;
    }

    /**
     * @test
     * @depends errorContainsMessageAndItsContextData
     */
    public function canBeCastedToString(Error $error): void
    {
        self::assertSame('Something went wrong', (string) $error);
    }
}
