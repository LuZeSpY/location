<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331191810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement ADD locataire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD appartement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1ED8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B1DC7A1ED8A38199 ON paiement (locataire_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EE1729BBA ON paiement (appartement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1ED8A38199');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1EE1729BBA');
        $this->addSql('DROP INDEX IDX_B1DC7A1ED8A38199');
        $this->addSql('DROP INDEX IDX_B1DC7A1EE1729BBA');
        $this->addSql('ALTER TABLE paiement DROP locataire_id');
        $this->addSql('ALTER TABLE paiement DROP appartement_id');
    }
}
