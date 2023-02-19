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

namespace App\Factory;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use App\Status\CharacterStatus;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Character>
 *
 * @method        Character|Proxy                     create(array|callable $attributes = [])
 * @method static Character|Proxy                     createOne(array $attributes = [])
 * @method static Character|Proxy                     find(object|array|mixed $criteria)
 * @method static Character|Proxy                     findOrCreate(array $attributes)
 * @method static Character|Proxy                     first(string $sortedField = 'id')
 * @method static Character|Proxy                     last(string $sortedField = 'id')
 * @method static Character|Proxy                     random(array $attributes = [])
 * @method static Character|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CharacterRepository|RepositoryProxy repository()
 * @method static Character[]|Proxy[]                 all()
 * @method static Character[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Character[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Character[]|Proxy[]                 findBy(array $attributes)
 * @method static Character[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Character[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CharacterFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Character::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function getDefaults(): array
    {
        return [
            'code' => self::faker()->slug(1),
            'name' => self::faker()->text(127),
            'owner' => UserFactory::new(),
            'status' => self::faker()->randomElement(CharacterStatus::STATUS),
            'statusAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }
}
