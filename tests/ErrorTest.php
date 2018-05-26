<?php
/**
 * This file is part of Zee Project.
 *
 * @see https://github.com/zee/
 */

declare(strict_types=1);

namespace Zee\Errors\Tests;

use Zee\Errors\Error;

/**
 * Class ErrorTest.
 */
final class ErrorTest extends TestCase
{
    /**
     * @test
     *
     * @return Error
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
     *
     * @param Error $error
     */
    public function canBeCastedToString(Error $error)
    {
        self::assertSame('Something went wrong', (string) $error);
    }
}
