<?php

/**
 * This file is part of the BB-One Project
 *
 * PHP 8.2 | Symfony 6.2+
 *
 * Copyright LongitudeOne - Alexandre Tranchant
 * Copyright 2023 - 2023
 *
 */

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class AuthenticationTest extends ApiTestCase
{
    public function getAdminToken(): string
    {
        return $this->getToken('admin');
    }

    public function getToken(string $role): string
    {
        $response = static::createClient()->request('POST', '/auth', [
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
            ],
            'json' => [
                'username' => strtolower($role).'@example.org',
                'password' => 'password',
            ],
        ]);

        self::assertResponseStatusCodeSame(200);

        return $response->toArray()['token'];
    }

    public function getUserToken(): string
    {
        return $this->getToken('user');
    }
}
