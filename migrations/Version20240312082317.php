<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312082317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_pendu (user_id INT NOT NULL, pendu_id INT NOT NULL, INDEX IDX_B27D2681A76ED395 (user_id), INDEX IDX_B27D26818B51DE90 (pendu_id), PRIMARY KEY(user_id, pendu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_pendu ADD CONSTRAINT FK_B27D2681A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_pendu ADD CONSTRAINT FK_B27D26818B51DE90 FOREIGN KEY (pendu_id) REFERENCES pendu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_pendu DROP FOREIGN KEY FK_B27D2681A76ED395');
        $this->addSql('ALTER TABLE user_pendu DROP FOREIGN KEY FK_B27D26818B51DE90');
        $this->addSql('DROP TABLE user_pendu');
    }
}
