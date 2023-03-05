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
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
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

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    private static function assertHydraCollectionContainsKeysInMember(array $keys, ResponseInterface $response): void
    {
        self::assertJsonContains(['@type' => 'hydra:Collection']);

        $hydraMembers = $response->toArray()['hydra:member'];
        $firstMember = array_shift($hydraMembers);
        if (null === $firstMember) {
            self::fail('The collection is empty! Did you forget to load initial data fixtures? Try to launch `php bin/console doctrine:fixtures:load --env=test`');
        }

        foreach ($keys as $key) {
            self::assertArrayHasKey($key, $firstMember);
        }
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    private static function assertHydraCollectionNotContainsKeysInMember(array $keys, ResponseInterface $response): void
    {
        self::assertJsonContains(['@type' => 'hydra:Collection']);

        $hydraMembers = $response->toArray()['hydra:member'];
        $firstMember = array_shift($hydraMembers);

        foreach ($keys as $key) {
            self::assertArrayNotHasKey($key, $firstMember);
        }
    }

    public function testGetUsers(): void
    {
        try {
            $response = $this->client->request('GET', '/users', [
                'headers' => ['Content-Type' => 'application/ld+json'],
            ]);
            self::assertResponseIsSuccessful();
            self::assertHydraCollectionContainsKeysInMember(['@id', '@type', 'username'], $response);
            self::assertHydraCollectionNotContainsKeysInMember(['email', 'password', 'plainPassword'], $response);
        } catch (ClientExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
            self::fail($e->getMessage());
        }
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

    public function testLoginWithValidCredentials(): void
    {
        $response = $this->client->request('POST', '/login', [
            'json' => [
                'email' => 'user@example.org',
                'password' => 'password',
            ],
        ]);


        self::assertResponseIsSuccessful();
    }
}
