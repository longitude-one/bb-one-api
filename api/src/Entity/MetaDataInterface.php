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

/**
 * MetaData Interface are designed to be displayed on an HTML website.
 * Interface promises methods to be displayed on an HTML website.
 */
interface MetaDataInterface
{
    /**
     * The code could be used as a css classname the uniq keyword like a slug.
     */
    public function getCode(): ?string;

    /**
     * The description could be used as the inner text of a paragraph.
     */
    public function getDescription(): ?string;

    /**
     * The label could be used as the inner text of the HTML element.
     */
    public function getLabel(): ?string;

    /**
     * The pitch could be used as the title attribut of a link.
     */
    public function getPitch(): ?string;
}
