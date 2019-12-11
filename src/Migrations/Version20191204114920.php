<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204114920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bovin CHANGE categories_id categories_id INT DEFAULT NULL, CHANGE races_id races_id INT DEFAULT NULL, CHANGE types_id types_id INT DEFAULT NULL, CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE clients_id clients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_commande CHANGE produits_id produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_medicale CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lait DROP FOREIGN KEY FK_FAF6537BFACB6020');
        $this->addSql('DROP INDEX IDX_FAF6537BFACB6020 ON lait');
        $this->addSql('ALTER TABLE lait DROP stocks_id, CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE categories_id categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD laits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660C842601 FOREIGN KEY (laits_id) REFERENCES lait (id)');
        $this->addSql('CREATE INDEX IDX_4B365660C842601 ON stock (laits_id)');
        $this->addSql('ALTER TABLE traitement CHANGE bovin_id bovin_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bovin CHANGE categories_id categories_id INT DEFAULT NULL, CHANGE races_id races_id INT DEFAULT NULL, CHANGE types_id types_id INT DEFAULT NULL, CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE clients_id clients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_commande CHANGE produits_id produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_medicale CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lait ADD stocks_id INT DEFAULT NULL, CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lait ADD CONSTRAINT FK_FAF6537BFACB6020 FOREIGN KEY (stocks_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_FAF6537BFACB6020 ON lait (stocks_id)');
        $this->addSql('ALTER TABLE livraison CHANGE commande_id commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production CHANGE bovin_id bovin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE categories_id categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660C842601');
        $this->addSql('DROP INDEX IDX_4B365660C842601 ON stock');
        $this->addSql('ALTER TABLE stock DROP laits_id');
        $this->addSql('ALTER TABLE traitement CHANGE bovin_id bovin_id INT DEFAULT NULL');
    }
}
