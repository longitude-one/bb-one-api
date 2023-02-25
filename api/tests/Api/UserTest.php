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
use Symfony\Contracts\HttpClient\ResponseInterface;

class UserTest extends ApiTestCase
{
    private static function assertHydraCollectionContainsKeys(array $keys, ResponseInterface $response): void
    {
        self::assertJsonContains([
            '@type' => 'hydra:Collection',
        ]);

        $hydraMembers = $response->toArray()['hydra:member'];
        $firstMember = array_shift($hydraMembers);

        foreach ($keys as $key) {
            self::assertArrayHasKey($key, $firstMember);
        }
    }

    private static function assertHydraCollectionNotContainsKeys(array $keys, ResponseInterface $response): void
    {
        self::assertJsonContains([
            '@type' => 'hydra:Collection',
        ]);

        $hydraMembers = $response->toArray()['hydra:member'];
        $firstMember = array_shift($hydraMembers);

        foreach ($keys as $key) {
            self::assertArrayNotHasKey($key, $firstMember);
        }
    }

    public function testGetUsers(): void
    {
        $response = static::createClient()->request('GET', '/users');

        self::assertResponseIsSuccessful();
        self::assertHydraCollectionContainsKeys(['@id', '@type', 'username'], $response);
        self::assertHydraCollectionNotContainsKeys(['email', 'password', 'plainPassword'], $response);
    }
}
