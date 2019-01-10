<?php
/**
 * This file is part of Zee Project.
 *
 * @see https://github.com/zee/
 */

declare(strict_types=1);

namespace Zee\Errors\Tests;

use Zee\Errors\Error;
use Zee\Errors\Notification;

/**
 * Class NotificationTest.
 */
final class NotificationTest extends TestCase
{
    /**
     * @test
     *
     * @return Notification
     */
    public function canAddMultipleErrorsAndCountThem(): Notification
    {
        $notification = new Notification();
        $notification->addError('John missed the party');
        $notification->addError('Jane missed the party');

        self::assertTrue($notification->hasErrors());
        self::assertCount(2, $notification);

        return $notification;
    }

    /**
     * @test
     * @depends canAddMultipleErrorsAndCountThem
     *
     * @param Notification $notification
     */
    public function canIterateErrors(Notification $notification): void
    {
        foreach ($notification as $error) {
            self::assertInstanceOf(Error::class, $error);
        }
    }

    /**
     * @test
     * @depends canAddMultipleErrorsAndCountThem
     *
     * @param Notification $notification
     */
    public function canGenerateListOfErrorMessages(Notification $notification): void
    {
        self::assertSame(['John missed the party', 'Jane missed the party'], $notification->getErrorMessages());
    }

    /**
     * @test
     * @depends canAddMultipleErrorsAndCountThem
     *
     * @param Notification $notification
     */
    public function canClearNotificationErrors(Notification $notification): void
    {
        $errors = $notification->flushErrors();
        self::assertFalse($notification->hasErrors());
        self::assertCount(0, $notification);
        self::assertCount(2, $errors);
    }
}
