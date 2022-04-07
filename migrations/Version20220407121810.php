<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407121810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal CHANGE gender gender TINYINT(1) NOT NULL, CHANGE child_compatibility child_compatibility TINYINT(1) NOT NULL, CHANGE other_animal_compatibility other_animal_compatibility TINYINT(1) NOT NULL, CHANGE garden_needed garden_needed TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE association CHANGE siren siren VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal CHANGE gender gender VARCHAR(255) NOT NULL, CHANGE child_compatibility child_compatibility VARCHAR(255) NOT NULL, CHANGE other_animal_compatibility other_animal_compatibility VARCHAR(255) NOT NULL, CHANGE garden_needed garden_needed VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE association CHANGE siren siren INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
