<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200609201843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create User table';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($schema->hasTable('users'));

        $this->addSql('
            CREATE TABLE users (
                id INT unsigned auto_increment,
                username VARCHAR(40) NOT NULL,
                password VARCHAR(100) NOT NULL,
                name VARCHAR(90) NOT NULL,
                created_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_datetime TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                PRIMARY KEY (id),
                UNIQUE (username)
            );
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(!$schema->hasTable('users'));

        $this->addSql('DROP users');
    }
}
