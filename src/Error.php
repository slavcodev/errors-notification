<?php
/**
 * This file is part of Zee Project.
 *
 * @see https://github.com/zee/
 */

declare(strict_types=1);

namespace Zee\Errors;

/**
 * Class Error.
 */
final class Error
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $context;

    /**
     * @param string $message
     * @param array $context
     */
    public function __construct(string $message, array $context)
    {
        $this->message = $message;
        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->getMessage();
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
