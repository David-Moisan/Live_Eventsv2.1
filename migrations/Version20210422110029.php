<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422110029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, id_program_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, hours VARCHAR(255) NOT NULL, scene VARCHAR(255) NOT NULL, INDEX IDX_15996879B3287DD (id_program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996879B3287DD FOREIGN KEY (id_program_id) REFERENCES program (id)');
        $this->addSql('DROP TABLE program_for_day');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE program_for_day (id INT AUTO_INCREMENT NOT NULL, rel_program_id INT NOT NULL, artist VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hours VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, scene VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_DDFBF23D24A0075 (rel_program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE program_for_day ADD CONSTRAINT FK_DDFBF23D24A0075 FOREIGN KEY (rel_program_id) REFERENCES program (id)');
        $this->addSql('DROP TABLE artist');
    }
}
