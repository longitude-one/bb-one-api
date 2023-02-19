<?php

declare(strict_types=1);

/**
 * This file is part of the BB-One Project
 *
 * PHP 8.2 | Symfony 6.2+
 *
 * Copyright LongitudeOne - Alexandre Tranchant
 * Copyright 2023 - 2023
 *
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230219124332 extends AbstractMigration
{
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE "bbone_characters" DROP CONSTRAINT FK_14AAE1707E3C61F9');
        $this->addSql('ALTER TABLE "bbone_characters" ALTER status TYPE SMALLINT');
        $this->addSql('DROP INDEX IDX_14AAE1707E3C61F9');
        $this->addSql('ALTER TABLE "bbone_characters" DROP owner_id');
    }

    public function getDescription(): string
    {
        return 'Relation between characters and users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bbone_characters ALTER status TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE bbone_characters ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bbone_characters ADD CONSTRAINT FK_14AAE1707E3C61F9 FOREIGN KEY (owner_id) REFERENCES "bbone_users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_14AAE1707E3C61F9 ON bbone_characters (owner_id)');
    }
}
