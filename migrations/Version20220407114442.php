<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407114442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data (id INT AUTO_INCREMENT NOT NULL, stn INT NOT NULL, date DATE DEFAULT NULL, time TIME DEFAULT NULL, temp DOUBLE PRECISION DEFAULT NULL, dewp DOUBLE PRECISION DEFAULT NULL, stp DOUBLE PRECISION DEFAULT NULL, slp DOUBLE PRECISION DEFAULT NULL, visib DOUBLE PRECISION DEFAULT NULL, wdsp DOUBLE PRECISION DEFAULT NULL, prcp DOUBLE PRECISION DEFAULT NULL, sndp DOUBLE PRECISION DEFAULT NULL, frshtt VARCHAR(64) DEFAULT NULL, cldc DOUBLE PRECISION DEFAULT NULL, wnddir INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE weatherdata');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE weatherdata (id INT AUTO_INCREMENT NOT NULL, stn INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, temp DOUBLE PRECISION NOT NULL, dewp DOUBLE PRECISION NOT NULL, stp DOUBLE PRECISION NOT NULL, slp DOUBLE PRECISION NOT NULL, visib DOUBLE PRECISION NOT NULL, wdsp DOUBLE PRECISION NOT NULL, prcp DOUBLE PRECISION NOT NULL, sndp DOUBLE PRECISION NOT NULL, frshtt VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cldc DOUBLE PRECISION NOT NULL, wnddir INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE data');
    }
}
