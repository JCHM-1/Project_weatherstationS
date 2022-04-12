<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412124516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE join_table_profile_station RENAME INDEX station_id_idx TO station_id');
        $this->addSql('ALTER TABLE profile RENAME INDEX subscription_idx TO IDX_8157AA0FA3C664D3');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE join_table_profile_station RENAME INDEX station_id TO station_id_idx');
        $this->addSql('ALTER TABLE profile RENAME INDEX idx_8157aa0fa3c664d3 TO subscription_idx');
    }
}
