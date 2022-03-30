<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330121453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `geolocation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `station_name` varchar(10) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `island` varchar(100) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `hamlet` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `state_district` varchar(100) DEFAULT NULL,
  `administrative` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_geolocation_station_name` (`station_name`),
  KEY `fk_geolocation_country_code` (`country_code`),
  CONSTRAINT `fk_geolocation_country_code` FOREIGN KEY (`country_code`) REFERENCES `country` (`country_code`),
  CONSTRAINT `fk_geolocation_station_name` FOREIGN KEY (`station_name`) REFERENCES `station` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8001 DEFAULT CHARSET=utf16;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE IF EXISTS `geolocation`;');

    }
}
