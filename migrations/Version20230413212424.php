<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413212424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etat_lieux ADD appartement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etat_lieux ADD CONSTRAINT FK_D8D38417E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D8D38417E1729BBA ON etat_lieux (appartement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etat_lieux DROP CONSTRAINT FK_D8D38417E1729BBA');
        $this->addSql('DROP INDEX IDX_D8D38417E1729BBA');
        $this->addSql('ALTER TABLE etat_lieux DROP appartement_id');
    }
}
