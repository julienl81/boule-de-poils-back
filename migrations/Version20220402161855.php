<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220402161855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD department_id INT NOT NULL, ADD species_id INT NOT NULL, ADD association_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FAE80F5DF ON animal (department_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FB2A1D860 ON animal (species_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FEFB9C8A5 ON animal (association_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAE80F5DF');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB2A1D860');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FEFB9C8A5');
        $this->addSql('DROP INDEX IDX_6AAB231FAE80F5DF ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231FB2A1D860 ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231FEFB9C8A5 ON animal');
        $this->addSql('ALTER TABLE animal DROP department_id, DROP species_id, DROP association_id');
    }
}
