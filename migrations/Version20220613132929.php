<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613132929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (country_code VARCHAR(2) NOT NULL, country VARCHAR(45) NOT NULL, PRIMARY KEY(country_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data (id INT AUTO_INCREMENT NOT NULL, stn INT NOT NULL, date DATE DEFAULT NULL, time TIME DEFAULT NULL, temp DOUBLE PRECISION DEFAULT NULL, dewp DOUBLE PRECISION DEFAULT NULL, stp DOUBLE PRECISION DEFAULT NULL, slp DOUBLE PRECISION DEFAULT NULL, visib DOUBLE PRECISION DEFAULT NULL, wdsp DOUBLE PRECISION DEFAULT NULL, prcp DOUBLE PRECISION DEFAULT NULL, sndp DOUBLE PRECISION DEFAULT NULL, frshtt VARCHAR(64) DEFAULT NULL, cldc DOUBLE PRECISION DEFAULT NULL, wnddir INT DEFAULT NULL, INDEX stn_idx (stn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geolocation (id INT AUTO_INCREMENT NOT NULL, station_name INT DEFAULT NULL, country_code VARCHAR(2) NOT NULL, island VARCHAR(100) DEFAULT NULL, county VARCHAR(100) DEFAULT NULL, place VARCHAR(100) DEFAULT NULL, hamlet VARCHAR(100) DEFAULT NULL, town VARCHAR(100) DEFAULT NULL, municipality VARCHAR(100) DEFAULT NULL, state_district VARCHAR(100) DEFAULT NULL, administrative VARCHAR(100) DEFAULT NULL, state VARCHAR(100) DEFAULT NULL, village VARCHAR(100) DEFAULT NULL, region VARCHAR(100) DEFAULT NULL, province VARCHAR(100) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, locality VARCHAR(100) DEFAULT NULL, postcode VARCHAR(100) DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, INDEX country_code (country_code), INDEX fk_station_name_idx (station_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE join_table_profile_station (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, station_id INT DEFAULT NULL, INDEX profile_id (profile_id), INDEX station_id (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nearestlocation (id INT AUTO_INCREMENT NOT NULL, country_code VARCHAR(2) DEFAULT NULL, station_name INT DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, administrative_region1 VARCHAR(100) DEFAULT NULL, administrative_region2 VARCHAR(100) DEFAULT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, INDEX fk_nearestlocation_country_code (country_code), INDEX station_name_idx (station_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, subscription INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0FE7927C74 (email), INDEX IDX_8157AA0FA3C664D3 (subscription), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (name INT AUTO_INCREMENT NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, elevation DOUBLE PRECISION NOT NULL, PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriptions (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, realtime TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE geolocation ADD CONSTRAINT FK_9DC0E5B4B010593B FOREIGN KEY (station_name) REFERENCES station (name)');
        $this->addSql('ALTER TABLE join_table_profile_station ADD CONSTRAINT FK_5D741489CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE join_table_profile_station ADD CONSTRAINT FK_5D74148921BDB235 FOREIGN KEY (station_id) REFERENCES station (name)');
        $this->addSql('ALTER TABLE nearestlocation ADD CONSTRAINT FK_C1FA631FF026BB7C FOREIGN KEY (country_code) REFERENCES country (country_code)');
        $this->addSql('ALTER TABLE nearestlocation ADD CONSTRAINT FK_C1FA631FB010593B FOREIGN KEY (station_name) REFERENCES station (name)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA3C664D3 FOREIGN KEY (subscription) REFERENCES subscriptions (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nearestlocation DROP FOREIGN KEY FK_C1FA631FF026BB7C');
        $this->addSql('ALTER TABLE join_table_profile_station DROP FOREIGN KEY FK_5D741489CCFA12B8');
        $this->addSql('ALTER TABLE geolocation DROP FOREIGN KEY FK_9DC0E5B4B010593B');
        $this->addSql('ALTER TABLE join_table_profile_station DROP FOREIGN KEY FK_5D74148921BDB235');
        $this->addSql('ALTER TABLE nearestlocation DROP FOREIGN KEY FK_C1FA631FB010593B');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA3C664D3');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE data');
        $this->addSql('DROP TABLE geolocation');
        $this->addSql('DROP TABLE join_table_profile_station');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE nearestlocation');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE subscriptions');
    }
}
