<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408103125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data DROP FOREIGN KEY name');
        $this->addSql('DROP INDEX name_idx ON data');
        $this->addSql('ALTER TABLE geolocation CHANGE station_name station_name VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE nearestlocation CHANGE station_name station_name VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE nearestlocation ADD CONSTRAINT FK_C1FA631FB010593B FOREIGN KEY (station_name) REFERENCES station (name)');
        $this->addSql('ALTER TABLE station CHANGE name name VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data ADD CONSTRAINT name FOREIGN KEY (stn) REFERENCES station (name) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX name_idx ON data (stn)');
        $this->addSql('ALTER TABLE geolocation CHANGE station_name station_name INT NOT NULL');
        $this->addSql('ALTER TABLE nearestlocation DROP FOREIGN KEY FK_C1FA631FB010593B');
        $this->addSql('ALTER TABLE nearestlocation CHANGE station_name station_name INT DEFAULT NULL');
        $this->addSql('ALTER TABLE station CHANGE name name INT NOT NULL');
    }
}
