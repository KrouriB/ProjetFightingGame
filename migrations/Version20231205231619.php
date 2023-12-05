<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205231619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessory ADD image_path LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnage ADD image_path LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE weapon ADD image_path LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessory DROP image_path');
        $this->addSql('ALTER TABLE personnage DROP image_path');
        $this->addSql('ALTER TABLE weapon DROP image_path');
    }
}
