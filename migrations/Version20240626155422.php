<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626155422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE personal_budget_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personal_budget_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE personal_budget (id INT NOT NULL, owner VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personal_budget_item (id INT NOT NULL, budget_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B349540114550BA1 ON personal_budget_item (budget_id_id)');
        $this->addSql('ALTER TABLE personal_budget_item ADD CONSTRAINT FK_B349540114550BA1 FOREIGN KEY (budget_id_id) REFERENCES personal_budget (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE personal_budget_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personal_budget_item_id_seq CASCADE');
        $this->addSql('ALTER TABLE personal_budget_item DROP CONSTRAINT FK_B349540114550BA1');
        $this->addSql('DROP TABLE personal_budget');
        $this->addSql('DROP TABLE personal_budget_item');
    }
}
