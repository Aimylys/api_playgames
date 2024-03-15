<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312085303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pendu (id INT AUTO_INCREMENT NOT NULL, score INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score_total (id INT AUTO_INCREMENT NOT NULL, score_total_id INT DEFAULT NULL, INDEX IDX_7B632DD61BD4E6C4 (score_total_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, score_pendu_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, points INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6497C5201E8 (score_pendu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score_total ADD CONSTRAINT FK_7B632DD61BD4E6C4 FOREIGN KEY (score_total_id) REFERENCES pendu (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497C5201E8 FOREIGN KEY (score_pendu_id) REFERENCES score_total (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_total DROP FOREIGN KEY FK_7B632DD61BD4E6C4');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497C5201E8');
        $this->addSql('DROP TABLE pendu');
        $this->addSql('DROP TABLE score_total');
        $this->addSql('DROP TABLE user');
    }
}
