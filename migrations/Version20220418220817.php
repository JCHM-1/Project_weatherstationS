<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418220817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data (id INT AUTO_INCREMENT NOT NULL, stn INT NOT NULL, date DATE DEFAULT NULL, time TIME DEFAULT NULL, temp DOUBLE PRECISION DEFAULT NULL, dewp DOUBLE PRECISION DEFAULT NULL, stp DOUBLE PRECISION DEFAULT NULL, slp DOUBLE PRECISION DEFAULT NULL, visib DOUBLE PRECISION DEFAULT NULL, wdsp DOUBLE PRECISION DEFAULT NULL, prcp DOUBLE PRECISION DEFAULT NULL, sndp DOUBLE PRECISION DEFAULT NULL, frshtt VARCHAR(64) DEFAULT NULL, cldc DOUBLE PRECISION DEFAULT NULL, wnddir INT DEFAULT NULL, INDEX stn_idx (stn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE join_table_profile_station ADD id INT AUTO_INCREMENT NOT NULL, DROP prim_id, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE station CHANGE name name INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE data');
        $this->addSql('ALTER TABLE join_table_profile_station MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE join_table_profile_station DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE join_table_profile_station ADD prim_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE station CHANGE name name INT NOT NULL');
    }
}
