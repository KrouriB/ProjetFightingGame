<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102150138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe_accessory DROP FOREIGN KEY FK_FDC040E76D861B89');
        $this->addSql('ALTER TABLE equipe_accessory DROP FOREIGN KEY FK_FDC040E727E8CC78');
        $this->addSql('ALTER TABLE equipe_personnage DROP FOREIGN KEY FK_40D9129C6D861B89');
        $this->addSql('ALTER TABLE equipe_personnage DROP FOREIGN KEY FK_40D9129C5E315342');
        $this->addSql('ALTER TABLE equipe_weapon DROP FOREIGN KEY FK_6404C14E95B82273');
        $this->addSql('ALTER TABLE equipe_weapon DROP FOREIGN KEY FK_6404C14E6D861B89');
        $this->addSql('DROP TABLE equipe_accessory');
        $this->addSql('DROP TABLE equipe_personnage');
        $this->addSql('DROP TABLE equipe_weapon');
        $this->addSql('ALTER TABLE equipe ADD personnage_id INT NOT NULL, ADD weapon_id INT NOT NULL, ADD accessory_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA155E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1595B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1527E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id)');
        $this->addSql('CREATE INDEX IDX_2449BA155E315342 ON equipe (personnage_id)');
        $this->addSql('CREATE INDEX IDX_2449BA1595B82273 ON equipe (weapon_id)');
        $this->addSql('CREATE INDEX IDX_2449BA1527E8CC78 ON equipe (accessory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe_accessory (equipe_id INT NOT NULL, accessory_id INT NOT NULL, INDEX IDX_FDC040E76D861B89 (equipe_id), INDEX IDX_FDC040E727E8CC78 (accessory_id), PRIMARY KEY(equipe_id, accessory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipe_personnage (equipe_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_40D9129C6D861B89 (equipe_id), INDEX IDX_40D9129C5E315342 (personnage_id), PRIMARY KEY(equipe_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipe_weapon (equipe_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_6404C14E6D861B89 (equipe_id), INDEX IDX_6404C14E95B82273 (weapon_id), PRIMARY KEY(equipe_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipe_accessory ADD CONSTRAINT FK_FDC040E76D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_accessory ADD CONSTRAINT FK_FDC040E727E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_personnage ADD CONSTRAINT FK_40D9129C6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_personnage ADD CONSTRAINT FK_40D9129C5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_weapon ADD CONSTRAINT FK_6404C14E95B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_weapon ADD CONSTRAINT FK_6404C14E6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA155E315342');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1595B82273');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1527E8CC78');
        $this->addSql('DROP INDEX IDX_2449BA155E315342 ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA1595B82273 ON equipe');
        $this->addSql('DROP INDEX IDX_2449BA1527E8CC78 ON equipe');
        $this->addSql('ALTER TABLE equipe DROP personnage_id, DROP weapon_id, DROP accessory_id');
    }
}
