<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111080422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timesheet DROP FOREIGN KEY FK_77A4E8D4DCD6110');
        $this->addSql('DROP INDEX IDX_77A4E8D4DCD6110 ON timesheet');
        $this->addSql('ALTER TABLE timesheet DROP stock_id, CHANGE hour hour DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timesheet ADD stock_id INT DEFAULT NULL, CHANGE hour hour DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D4DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_77A4E8D4DCD6110 ON timesheet (stock_id)');
    }
}
