<?php
/**
 * {@see https://github.com/zee/ Zee Project (c)}
 */

declare(strict_types=1);

namespace Zee\Errors;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

final class Notification implements Countable, IteratorAggregate
{
    private $errors = [];

    /**
     * Adds new error to the notification.
     */
    public function addError(string $message, array $context = []): void
    {
        $this->errors[] = new Error($message, $context);
    }

    /**
     * Returns whether the notification has any errors.
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Flushes the notification errors.
     */
    public function flushErrors(): array
    {
        $errors = $this->errors;
        $this->errors = [];

        return $errors;
    }

    /**
     * Returns list of error messages only.
     */
    public function getErrorMessages(): array
    {
        return array_map(
            function (Error $error) {
                return $error->getMessage();
            },
            $this->errors
        );
    }

    /**
     * Counts the errors in the notification.
     */
    public function count(): int
    {
        return count($this->errors);
    }

    /**
     * Builds the iterator by errors.
     *
     * @return Error[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->errors);
    }
}
