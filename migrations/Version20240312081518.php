<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312081518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497C5201E8');
        $this->addSql('DROP INDEX IDX_8D93D6497C5201E8 ON user');
        $this->addSql('ALTER TABLE user DROP score_pendu_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD score_pendu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497C5201E8 FOREIGN KEY (score_pendu_id) REFERENCES pendu (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497C5201E8 ON user (score_pendu_id)');
    }
}
