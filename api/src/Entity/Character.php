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

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CharacterRepository;
use App\Status\CharacterStatus;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ApiResource(
    description: 'Each validated character can played in the game.',
    normalizationContext: ['groups' => ['character:read']],
    denormalizationContext: ['groups' => ['character:draft']],
    mercure: true,
)]
class Character implements MetaDataInterface
{
    #[ORM\Column(length: 137)]
    #[Groups(['character:read'])]
    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['character:read', 'character:draft'])]
    private ?string $description = null;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 127)]
    #[Groups(['character:read', 'character:draft'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['character:read', 'character:draft'])]
    private ?string $pitch = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['character:read'])]
    private string $status = CharacterStatus::STATUS_DRAFT;

    #[ORM\Column]
    #[Groups(['character:read'])]
    private ?\DateTimeImmutable $statusAt = null;

    public function __construct()
    {
        $this->statusAt = new \DateTimeImmutable();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->getName();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPitch(): ?string
    {
        return $this->pitch;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStatusAt(): ?\DateTimeImmutable
    {
        return $this->statusAt;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPitch(string $pitch): self
    {
        $this->pitch = $pitch;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setStatusAt(\DateTimeImmutable $statusAt): self
    {
        $this->statusAt = $statusAt;

        return $this;
    }
}
