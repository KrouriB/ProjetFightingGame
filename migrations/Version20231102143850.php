<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102143850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe_accessory (equipe_id INT NOT NULL, accessory_id INT NOT NULL, INDEX IDX_FDC040E76D861B89 (equipe_id), INDEX IDX_FDC040E727E8CC78 (accessory_id), PRIMARY KEY(equipe_id, accessory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_weapon (equipe_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_6404C14E6D861B89 (equipe_id), INDEX IDX_6404C14E95B82273 (weapon_id), PRIMARY KEY(equipe_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe_accessory ADD CONSTRAINT FK_FDC040E76D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_accessory ADD CONSTRAINT FK_FDC040E727E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_weapon ADD CONSTRAINT FK_6404C14E6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_weapon ADD CONSTRAINT FK_6404C14E95B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D95B82273');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D27E8CC78');
        $this->addSql('DROP INDEX IDX_6AEA486D95B82273 ON personnage');
        $this->addSql('DROP INDEX IDX_6AEA486D27E8CC78 ON personnage');
        $this->addSql('ALTER TABLE personnage DROP weapon_id, DROP accessory_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe_accessory DROP FOREIGN KEY FK_FDC040E76D861B89');
        $this->addSql('ALTER TABLE equipe_accessory DROP FOREIGN KEY FK_FDC040E727E8CC78');
        $this->addSql('ALTER TABLE equipe_weapon DROP FOREIGN KEY FK_6404C14E6D861B89');
        $this->addSql('ALTER TABLE equipe_weapon DROP FOREIGN KEY FK_6404C14E95B82273');
        $this->addSql('DROP TABLE equipe_accessory');
        $this->addSql('DROP TABLE equipe_weapon');
        $this->addSql('ALTER TABLE personnage ADD weapon_id INT DEFAULT NULL, ADD accessory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D95B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D27E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6AEA486D95B82273 ON personnage (weapon_id)');
        $this->addSql('CREATE INDEX IDX_6AEA486D27E8CC78 ON personnage (accessory_id)');
    }
}
