<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testConstruct(): void
    {
        $user = new User();
        self::assertSame(['ROLE_USER'], $user->getRoles());
    }
}
