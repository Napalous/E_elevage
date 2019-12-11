<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203164027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bovin (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, races_id INT DEFAULT NULL, types_id INT DEFAULT NULL, bovin_id INT DEFAULT NULL, numero_ordre VARCHAR(10) NOT NULL, sexe VARCHAR(10) NOT NULL, date_naissance DATETIME NOT NULL, INDEX IDX_8DCBC36A21214B7 (categories_id), INDEX IDX_8DCBC3699AE984C (races_id), INDEX IDX_8DCBC368EB23357 (types_id), INDEX IDX_8DCBC3681B22351 (bovin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, datecreation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, tel VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, clients_id INT DEFAULT NULL, datecommande DATETIME NOT NULL, INDEX IDX_6EEAA67DAB014612 (clients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_commande (id INT AUTO_INCREMENT NOT NULL, produits_id INT DEFAULT NULL, qtecommandee INT NOT NULL, prix_unitaire INT NOT NULL, INDEX IDX_4BCD5F6CD11A2CF (produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, montant INT NOT NULL, date_facture DATETIME NOT NULL, INDEX IDX_FE86641082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_medicale (id INT AUTO_INCREMENT NOT NULL, bovin_id INT DEFAULT NULL, observation LONGTEXT NOT NULL, date_consultation DATETIME NOT NULL, INDEX IDX_20D232681B22351 (bovin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lait (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, bovin_id INT DEFAULT NULL, quantite NUMERIC(6, 2) NOT NULL, date_production DATETIME NOT NULL, INDEX IDX_FAF6537BDCD6110 (stock_id), INDEX IDX_FAF6537B81B22351 (bovin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, date_livraison DATETIME NOT NULL, INDEX IDX_A60C9F1F82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, bovin_id INT DEFAULT NULL, nbre_mise_bas INT NOT NULL, nbre_veau INT NOT NULL, nbre_vivant INT NOT NULL, nbre_mort INT NOT NULL, taux_production NUMERIC(10, 0) NOT NULL, taux_mortalite NUMERIC(10, 0) NOT NULL, date_production DATETIME NOT NULL, INDEX IDX_D3EDB1E081B22351 (bovin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, libelle VARCHAR(30) NOT NULL, prix INT NOT NULL, INDEX IDX_29A5EC27A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, photo LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reunion (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(30) NOT NULL, description LONGTEXT NOT NULL, date_reunion DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, quantite NUMERIC(6, 2) NOT NULL, date_stock DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traitement (id INT AUTO_INCREMENT NOT NULL, bovin_id INT DEFAULT NULL, traitement LONGTEXT NOT NULL, date_traitement DATETIME NOT NULL, INDEX IDX_2A356D2781B22351 (bovin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bovin ADD CONSTRAINT FK_8DCBC36A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE bovin ADD CONSTRAINT FK_8DCBC3699AE984C FOREIGN KEY (races_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE bovin ADD CONSTRAINT FK_8DCBC368EB23357 FOREIGN KEY (types_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE bovin ADD CONSTRAINT FK_8DCBC3681B22351 FOREIGN KEY (bovin_id) REFERENCES bovin (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F6CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE fiche_medicale ADD CONSTRAINT FK_20D232681B22351 FOREIGN KEY (bovin_id) REFERENCES bovin (id)');
        $this->addSql('ALTER TABLE lait ADD CONSTRAINT FK_FAF6537BDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE lait ADD CONSTRAINT FK_FAF6537B81B22351 FOREIGN KEY (bovin_id) REFERENCES bovin (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E081B22351 FOREIGN KEY (bovin_id) REFERENCES bovin (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE traitement ADD CONSTRAINT FK_2A356D2781B22351 FOREIGN KEY (bovin_id) REFERENCES bovin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bovin DROP FOREIGN KEY FK_8DCBC3681B22351');
        $this->addSql('ALTER TABLE fiche_medicale DROP FOREIGN KEY FK_20D232681B22351');
        $this->addSql('ALTER TABLE lait DROP FOREIGN KEY FK_FAF6537B81B22351');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E081B22351');
        $this->addSql('ALTER TABLE traitement DROP FOREIGN KEY FK_2A356D2781B22351');
        $this->addSql('ALTER TABLE bovin DROP FOREIGN KEY FK_8DCBC36A21214B7');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A21214B7');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAB014612');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641082EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F6CD11A2CF');
        $this->addSql('ALTER TABLE bovin DROP FOREIGN KEY FK_8DCBC3699AE984C');
        $this->addSql('ALTER TABLE lait DROP FOREIGN KEY FK_FAF6537BDCD6110');
        $this->addSql('ALTER TABLE bovin DROP FOREIGN KEY FK_8DCBC368EB23357');
        $this->addSql('DROP TABLE bovin');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE details_commande');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fiche_medicale');
        $this->addSql('DROP TABLE lait');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE reunion');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE traitement');
        $this->addSql('DROP TABLE type');
    }
}
