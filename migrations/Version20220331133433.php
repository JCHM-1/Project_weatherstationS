<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331133433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE weatherdata (id INT AUTO_INCREMENT NOT NULL, stn INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, temp DOUBLE PRECISION NOT NULL, dewp DOUBLE PRECISION NOT NULL, stp DOUBLE PRECISION NOT NULL, slp DOUBLE PRECISION NOT NULL, visib DOUBLE PRECISION NOT NULL, wdsp DOUBLE PRECISION NOT NULL, prcp DOUBLE PRECISION NOT NULL, sndp DOUBLE PRECISION NOT NULL, frshtt VARCHAR(255) NOT NULL, cldc DOUBLE PRECISION NOT NULL, wnddir INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE weatherdata');
    }
}
