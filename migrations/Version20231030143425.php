<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231030143425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_weapon CHANGE advantage_multiplicator advantage_multiplicator DOUBLE PRECISION NOT NULL, CHANGE disadvantage_multiplicator disadvantage_multiplicator DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE element CHANGE advantage_multiplicator advantage_multiplicator DOUBLE PRECISION NOT NULL, CHANGE disadvantage_multiplicator disadvantage_multiplicator DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE type_weapon CHANGE advantage_multiplicator advantage_multiplicator DOUBLE PRECISION NOT NULL, CHANGE disadvantage_multiplicator disadvantage_multiplicator DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_weapon CHANGE advantage_multiplicator advantage_multiplicator INT NOT NULL, CHANGE disadvantage_multiplicator disadvantage_multiplicator INT NOT NULL');
        $this->addSql('ALTER TABLE element CHANGE advantage_multiplicator advantage_multiplicator INT NOT NULL, CHANGE disadvantage_multiplicator disadvantage_multiplicator INT NOT NULL');
        $this->addSql('ALTER TABLE type_weapon CHANGE advantage_multiplicator advantage_multiplicator INT NOT NULL, CHANGE disadvantage_multiplicator disadvantage_multiplicator INT NOT NULL');
    }
}
