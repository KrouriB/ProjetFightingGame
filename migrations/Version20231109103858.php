<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109103858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessory ADD user_creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accessory ADD CONSTRAINT FK_A1B1251CC645C84A FOREIGN KEY (user_creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_A1B1251CC645C84A ON accessory (user_creator_id)');
        $this->addSql('ALTER TABLE personnage ADD user_creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DC645C84A FOREIGN KEY (user_creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6AEA486DC645C84A ON personnage (user_creator_id)');
        $this->addSql('ALTER TABLE weapon ADD user_creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E6C645C84A FOREIGN KEY (user_creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6933A7E6C645C84A ON weapon (user_creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DC645C84A');
        $this->addSql('DROP INDEX IDX_6AEA486DC645C84A ON personnage');
        $this->addSql('ALTER TABLE personnage DROP user_creator_id');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E6C645C84A');
        $this->addSql('DROP INDEX IDX_6933A7E6C645C84A ON weapon');
        $this->addSql('ALTER TABLE weapon DROP user_creator_id');
        $this->addSql('ALTER TABLE accessory DROP FOREIGN KEY FK_A1B1251CC645C84A');
        $this->addSql('DROP INDEX IDX_A1B1251CC645C84A ON accessory');
        $this->addSql('ALTER TABLE accessory DROP user_creator_id');
    }
}
