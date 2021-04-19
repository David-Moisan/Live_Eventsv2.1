<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419135800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaires ADD id_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE partenaires ADD CONSTRAINT FK_D230102E9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie_partenaires (id)');
        $this->addSql('CREATE INDEX IDX_D230102E9F34925F ON partenaires (id_categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaires DROP FOREIGN KEY FK_D230102E9F34925F');
        $this->addSql('DROP INDEX IDX_D230102E9F34925F ON partenaires');
        $this->addSql('ALTER TABLE partenaires DROP id_categorie_id');
    }
}
