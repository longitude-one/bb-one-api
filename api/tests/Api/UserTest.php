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
use ApiPlatform\Symfony\Bundle\Test\Client;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UserTest extends ApiTestCase
{
    private Client $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->client->setDefaultOptions([
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);
    }

    private static function assertHydraCollectionContainsKeys(array $keys, ResponseInterface $response): void
    {
        self::assertJsonContains([
            '@type' => 'hydra:Collection',
        ]);

        $hydraMembers = $response->toArray()['hydra:member'];
        $firstMember = array_shift($hydraMembers);
        if (null === $firstMember) {
            self::fail('The collection is empty! Did you forget to load initial data fixtures? Try to launch `php bin/console doctrine:fixtures:load --env=test`');
        }

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
        $response = $this->client->request('GET', '/users', [
            'headers' => ['Content-Type' => 'application/ld+json'],
        ]);

        self::assertResponseIsSuccessful();
        self::assertHydraCollectionContainsKeys(['@id', '@type', 'username'], $response);
        self::assertHydraCollectionNotContainsKeys(['email', 'password', 'plainPassword'], $response);
    }

    public function testLoginWithInvalidCredentials(): void
    {
        $this->client->request('POST', '/login', [
            'json' => [
                'email' => 'foo@example.com',
                'password' => 'foo',
            ],
        ]);

        self::assertResponseStatusCodeSame(401, 'Invalid credentials.');
    }
}
