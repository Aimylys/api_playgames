<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223114309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, joueur_a_id INT DEFAULT NULL, joueur_n_id INT DEFAULT NULL, gagnant_id INT DEFAULT NULL, etat VARCHAR(255) NOT NULL, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, INDEX IDX_59B1F3D834C8FF0 (joueur_a_id), INDEX IDX_59B1F3DDB2F9FA6 (joueur_n_id), INDEX IDX_59B1F3D2F942B8 (gagnant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D834C8FF0 FOREIGN KEY (joueur_a_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DDB2F9FA6 FOREIGN KEY (joueur_n_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D2F942B8 FOREIGN KEY (gagnant_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D834C8FF0');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DDB2F9FA6');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D2F942B8');
        $this->addSql('DROP TABLE partie');
    }
}
