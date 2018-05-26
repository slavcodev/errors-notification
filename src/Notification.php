<?php
/**
 * This file is part of Zee Project.
 *
 * @see https://github.com/zee/
 */

declare(strict_types=1);

namespace Zee\Errors;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * Class Notification.
 */
final class Notification implements Countable, IteratorAggregate
{
    private $errors = [];

    /**
     * Adds new error to the notification.
     *
     * @param string $message
     * @param array $context
     */
    public function addError(string $message, array $context = []): void
    {
        $this->errors[] = new Error($message, $context);
    }

    /**
     * Returns whether the notification has any errors.
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Clear the notification errors.
     */
    public function clearErrors(): void
    {
        $this->errors = [];
    }

    /**
     * @return array
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
     * Counts the errors.
     *
     * @inheritdoc
     */
    public function count(): int
    {
        return count($this->errors);
    }

    /**
     * Builds the iterator by errors.
     *
     * @inheritdoc
     *
     * @return Traversable|Error[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->errors);
    }
}
