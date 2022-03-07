<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220305070243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, no_id INT NOT NULL, categorie_id INT DEFAULT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4BDFF36B1A65C546 (no_id), INDEX IDX_4BDFF36BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite_fonctionnelle (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5665589BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_de_sante (id INT AUTO_INCREMENT NOT NULL, province_id INT NOT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_3443E1A3E946114A (province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B1A65C546 FOREIGN KEY (no_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE unite_fonctionnelle ADD CONSTRAINT FK_5665589BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE zone_de_sante ADD CONSTRAINT FK_3443E1A3E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B1A65C546');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36BBCF5E72D');
        $this->addSql('ALTER TABLE unite_fonctionnelle DROP FOREIGN KEY FK_5665589BCF5E72D');
        $this->addSql('ALTER TABLE zone_de_sante DROP FOREIGN KEY FK_3443E1A3E946114A');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP TABLE unite_fonctionnelle');
        $this->addSql('DROP TABLE zone_de_sante');
    }
}
