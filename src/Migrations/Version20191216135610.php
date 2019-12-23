<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216135610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_commande ADD date_details DATETIME NOT NULL, CHANGE produits_id produits_id INT DEFAULT NULL, CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bovin CHANGE categories_id categories_id INT DEFAULT NULL, CHANGE races_id races_id INT DEFAULT NULL, CHANGE types_id types_id INT DEFAULT NULL, CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE clients_id clients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lait CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE categories_id categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock CHANGE laits_id laits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traitement CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE fiche_medicale CHANGE bovin_id bovin_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bovin CHANGE categories_id categories_id INT DEFAULT NULL, CHANGE races_id races_id INT DEFAULT NULL, CHANGE types_id types_id INT DEFAULT NULL, CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE clients_id clients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_commande DROP date_details, CHANGE produits_id produits_id INT DEFAULT NULL, CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_medicale CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lait CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE categories_id categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock CHANGE laits_id laits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traitement CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
