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

final class Version20230219102539 extends AbstractMigration
{
    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE "bbone_users_id_seq" CASCADE');
        $this->addSql('DROP TABLE "bbone_users"');
    }

    public function getDescription(): string
    {
        return 'Create or drop users table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE "bbone_users_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "bbone_users" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UK_BBONE_USERS_EMAIL ON "bbone_users" (email)');
        $this->addSql('CREATE UNIQUE INDEX UK_BBONE_USERS_USERNAME ON "bbone_users" (username)');
    }
}
