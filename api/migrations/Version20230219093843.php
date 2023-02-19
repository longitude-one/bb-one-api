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

final class Version20230219093843 extends AbstractMigration
{
    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE bbone_characters_id_seq CASCADE');
        $this->addSql('DROP TABLE bbone_characters');
    }

    public function getDescription(): string
    {
        return 'Create or drop the character table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE bbone_characters_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bbone_characters (id INT NOT NULL, code VARCHAR(137) NOT NULL, description TEXT DEFAULT NULL, name VARCHAR(127) NOT NULL, pitch TEXT DEFAULT NULL, status SMALLINT NOT NULL, status_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN bbone_characters.status_at IS \'(DC2Type:datetime_immutable)\'');
    }
}
