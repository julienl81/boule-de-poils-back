<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720095510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal_user (animal_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CABE977D8E962C16 (animal_id), INDEX IDX_CABE977DA76ED395 (user_id), PRIMARY KEY(animal_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal_user ADD CONSTRAINT FK_CABE977D8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_user ADD CONSTRAINT FK_CABE977DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animal_user');
    }
}
