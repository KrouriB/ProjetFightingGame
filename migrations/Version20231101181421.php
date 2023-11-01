<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101181421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_stat_action CHANGE rank_stat1 rank_stat1 INT NOT NULL, CHANGE rank_stat2 rank_stat2 INT NOT NULL, CHANGE rank_stat3 rank_stat3 INT NOT NULL, CHANGE rank_stat4 rank_stat4 INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_stat_action CHANGE rank_stat1 rank_stat1 INT DEFAULT NULL, CHANGE rank_stat2 rank_stat2 INT DEFAULT NULL, CHANGE rank_stat3 rank_stat3 INT DEFAULT NULL, CHANGE rank_stat4 rank_stat4 INT DEFAULT NULL');
    }
}
