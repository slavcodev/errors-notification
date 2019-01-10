<?php
/**
 * {@see https://github.com/zee/ Zee Project (c)}
 */

declare(strict_types=1);

namespace Zee\Errors\Tests;

use Zee\Errors\Error;
use Zee\Errors\Notification;

final class NotificationTest extends TestCase
{
    /**
     * @test
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
     */
    public function canGenerateListOfErrorMessages(Notification $notification): void
    {
        self::assertSame(['John missed the party', 'Jane missed the party'], $notification->getErrorMessages());
    }

    /**
     * @test
     * @depends canAddMultipleErrorsAndCountThem
     */
    public function canClearNotificationErrors(Notification $notification): void
    {
        $errors = $notification->flushErrors();
        self::assertFalse($notification->hasErrors());
        self::assertCount(0, $notification);
        self::assertCount(2, $errors);
    }
}
