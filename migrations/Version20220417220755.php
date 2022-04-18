<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220417220755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data CHANGE stn stn INT DEFAULT NULL');
        $this->addSql('ALTER TABLE geolocation CHANGE station_name station_name INT DEFAULT NULL');
        $this->addSql('ALTER TABLE station CHANGE name name INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data CHANGE stn stn INT NOT NULL');
        $this->addSql('ALTER TABLE geolocation CHANGE station_name station_name INT NOT NULL');
        $this->addSql('ALTER TABLE station CHANGE name name INT NOT NULL');
    }
}
