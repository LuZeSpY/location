<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314105725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement ADD agence_id INT NOT NULL');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_71A6BD8DD725330D ON appartement (agence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE appartement DROP CONSTRAINT FK_71A6BD8DD725330D');
        $this->addSql('DROP INDEX IDX_71A6BD8DD725330D');
        $this->addSql('ALTER TABLE appartement DROP agence_id');
    }
}
