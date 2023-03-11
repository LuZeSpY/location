<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311145724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE appartement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etat_lieux_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE locataire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE location_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE paiement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE solde_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agence (id INT NOT NULL, nom_agence VARCHAR(255) NOT NULL, taux_frais DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE appartement (id INT NOT NULL, adresse VARCHAR(255) NOT NULL, complement VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, prix_charges DOUBLE PRECISION NOT NULL, prix_loyer DOUBLE PRECISION NOT NULL, superficie DOUBLE PRECISION NOT NULL, prix_depot_garantie DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etat_lieux (id INT NOT NULL, date_etat_lieux TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, remarque VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE locataire (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, complement VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE location (id INT NOT NULL, date_entree TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_sortie TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, depot_garantie_verse BOOLEAN NOT NULL, apl_versee BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE paiement (id INT NOT NULL, date_paiement TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE solde (id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE article ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE appartement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etat_lieux_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE locataire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE location_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE paiement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE solde_id_seq CASCADE');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE etat_lieux');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE solde');
        $this->addSql('ALTER TABLE article ALTER id SET DEFAULT 1');
    }
}
