<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330123347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `nearestlocation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `station_name` varchar(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `administrative_region1` varchar(100) DEFAULT NULL,
  `administrative_region2` varchar(100) DEFAULT NULL,
  `country_code` varchar(2) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nearestlocation_station_name` (`station_name`),
  KEY `fk_nearestlocation_country_code` (`country_code`),
  CONSTRAINT `fk_nearestlocation_country_code` FOREIGN KEY (`country_code`) REFERENCES `country` (`country_code`),
  CONSTRAINT `fk_nearestlocation_station_name` FOREIGN KEY (`station_name`) REFERENCES `station` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8001 DEFAULT CHARSET=utf16;');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE IF EXISTS `nearestlocation`;');

    }
}
