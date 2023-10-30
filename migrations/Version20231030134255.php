<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231030134255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessory (id INT AUTO_INCREMENT NOT NULL, type_stat_action_id INT NOT NULL, name VARCHAR(20) NOT NULL, min_life INT NOT NULL, defense INT NOT NULL, resistance INT NOT NULL, bonus_attack INT NOT NULL, bonus_magic INT NOT NULL, energy_recovery INT NOT NULL, cost INT NOT NULL, name_action VARCHAR(30) NOT NULL, energy_action INT NOT NULL, wait_action INT NOT NULL, stat_action INT NOT NULL, INDEX IDX_A1B1251CA513E897 (type_stat_action_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_weapon (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(50) NOT NULL, advantage INT NOT NULL, disadvantage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, name_element VARCHAR(50) NOT NULL, advantage INT NOT NULL, disadvantage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, assosiated_user_id INT DEFAULT NULL, team_name VARCHAR(20) NOT NULL, INDEX IDX_2449BA15DA9510BD (assosiated_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_personnage (equipe_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_40D9129C6D861B89 (equipe_id), INDEX IDX_40D9129C5E315342 (personnage_id), PRIMARY KEY(equipe_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, weapon_id INT NOT NULL, accessory_id INT NOT NULL, element_id INT NOT NULL, type_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(20) NOT NULL, attack INT NOT NULL, magic INT NOT NULL, energy INT NOT NULL, life INT NOT NULL, weapon_selection TINYINT(1) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_6AEA486D95B82273 (weapon_id), INDEX IDX_6AEA486D27E8CC78 (accessory_id), INDEX IDX_6AEA486D1F1F2A24 (element_id), INDEX IDX_6AEA486DC54C8C93 (type_id), INDEX IDX_6AEA486D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_accessory (id INT AUTO_INCREMENT NOT NULL, stock_user_id INT DEFAULT NULL, INDEX IDX_392CC3F4BEC8C336 (stock_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_accessory_accessory (stock_accessory_id INT NOT NULL, accessory_id INT NOT NULL, INDEX IDX_E7E200F7683F66B (stock_accessory_id), INDEX IDX_E7E200F727E8CC78 (accessory_id), PRIMARY KEY(stock_accessory_id, accessory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_personnage (id INT AUTO_INCREMENT NOT NULL, stock_user_id INT DEFAULT NULL, INDEX IDX_C4A3BFC1BEC8C336 (stock_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_personnage_personnage (stock_personnage_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_35BE6CF5DAAE79A6 (stock_personnage_id), INDEX IDX_35BE6CF55E315342 (personnage_id), PRIMARY KEY(stock_personnage_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_weapon (id INT AUTO_INCREMENT NOT NULL, stock_user_id INT DEFAULT NULL, INDEX IDX_A3157570BEC8C336 (stock_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_weapon_weapon (stock_weapon_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_D059A225D25C49B (stock_weapon_id), INDEX IDX_D059A22595B82273 (weapon_id), PRIMARY KEY(stock_weapon_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_stat_action (id INT AUTO_INCREMENT NOT NULL, nom_stat VARCHAR(30) NOT NULL, nom_type VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_weapon (id INT AUTO_INCREMENT NOT NULL, name_type VARCHAR(50) NOT NULL, advantage INT NOT NULL, disadvantage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, gold INT NOT NULL, kill_count INT NOT NULL, win_count INT NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, weapon_type_id INT NOT NULL, weapon_category_id INT NOT NULL, weapon_element_id INT NOT NULL, skill_element_id INT NOT NULL, name VARCHAR(20) NOT NULL, attack_stat INT NOT NULL, magic_stat INT NOT NULL, attack_skill INT NOT NULL, magic_skill INT NOT NULL, energy_skill INT NOT NULL, wait_skill INT NOT NULL, cost INT NOT NULL, name_skill VARCHAR(30) NOT NULL, INDEX IDX_6933A7E6607BCCD7 (weapon_type_id), INDEX IDX_6933A7E64011281B (weapon_category_id), INDEX IDX_6933A7E62048E597 (weapon_element_id), INDEX IDX_6933A7E6A96F656 (skill_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accessory ADD CONSTRAINT FK_A1B1251CA513E897 FOREIGN KEY (type_stat_action_id) REFERENCES type_stat_action (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15DA9510BD FOREIGN KEY (assosiated_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equipe_personnage ADD CONSTRAINT FK_40D9129C6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_personnage ADD CONSTRAINT FK_40D9129C5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D95B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D27E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D1F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DC54C8C93 FOREIGN KEY (type_id) REFERENCES type_weapon (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D12469DE2 FOREIGN KEY (category_id) REFERENCES category_weapon (id)');
        $this->addSql('ALTER TABLE stock_accessory ADD CONSTRAINT FK_392CC3F4BEC8C336 FOREIGN KEY (stock_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE stock_accessory_accessory ADD CONSTRAINT FK_E7E200F7683F66B FOREIGN KEY (stock_accessory_id) REFERENCES stock_accessory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_accessory_accessory ADD CONSTRAINT FK_E7E200F727E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_personnage ADD CONSTRAINT FK_C4A3BFC1BEC8C336 FOREIGN KEY (stock_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE stock_personnage_personnage ADD CONSTRAINT FK_35BE6CF5DAAE79A6 FOREIGN KEY (stock_personnage_id) REFERENCES stock_personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_personnage_personnage ADD CONSTRAINT FK_35BE6CF55E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_weapon ADD CONSTRAINT FK_A3157570BEC8C336 FOREIGN KEY (stock_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE stock_weapon_weapon ADD CONSTRAINT FK_D059A225D25C49B FOREIGN KEY (stock_weapon_id) REFERENCES stock_weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_weapon_weapon ADD CONSTRAINT FK_D059A22595B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E6607BCCD7 FOREIGN KEY (weapon_type_id) REFERENCES type_weapon (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E64011281B FOREIGN KEY (weapon_category_id) REFERENCES category_weapon (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E62048E597 FOREIGN KEY (weapon_element_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E6A96F656 FOREIGN KEY (skill_element_id) REFERENCES element (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessory DROP FOREIGN KEY FK_A1B1251CA513E897');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15DA9510BD');
        $this->addSql('ALTER TABLE equipe_personnage DROP FOREIGN KEY FK_40D9129C6D861B89');
        $this->addSql('ALTER TABLE equipe_personnage DROP FOREIGN KEY FK_40D9129C5E315342');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D95B82273');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D27E8CC78');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D1F1F2A24');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DC54C8C93');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D12469DE2');
        $this->addSql('ALTER TABLE stock_accessory DROP FOREIGN KEY FK_392CC3F4BEC8C336');
        $this->addSql('ALTER TABLE stock_accessory_accessory DROP FOREIGN KEY FK_E7E200F7683F66B');
        $this->addSql('ALTER TABLE stock_accessory_accessory DROP FOREIGN KEY FK_E7E200F727E8CC78');
        $this->addSql('ALTER TABLE stock_personnage DROP FOREIGN KEY FK_C4A3BFC1BEC8C336');
        $this->addSql('ALTER TABLE stock_personnage_personnage DROP FOREIGN KEY FK_35BE6CF5DAAE79A6');
        $this->addSql('ALTER TABLE stock_personnage_personnage DROP FOREIGN KEY FK_35BE6CF55E315342');
        $this->addSql('ALTER TABLE stock_weapon DROP FOREIGN KEY FK_A3157570BEC8C336');
        $this->addSql('ALTER TABLE stock_weapon_weapon DROP FOREIGN KEY FK_D059A225D25C49B');
        $this->addSql('ALTER TABLE stock_weapon_weapon DROP FOREIGN KEY FK_D059A22595B82273');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E6607BCCD7');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E64011281B');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E62048E597');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E6A96F656');
        $this->addSql('DROP TABLE accessory');
        $this->addSql('DROP TABLE category_weapon');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_personnage');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE stock_accessory');
        $this->addSql('DROP TABLE stock_accessory_accessory');
        $this->addSql('DROP TABLE stock_personnage');
        $this->addSql('DROP TABLE stock_personnage_personnage');
        $this->addSql('DROP TABLE stock_weapon');
        $this->addSql('DROP TABLE stock_weapon_weapon');
        $this->addSql('DROP TABLE type_stat_action');
        $this->addSql('DROP TABLE type_weapon');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE weapon');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
