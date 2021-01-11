<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111082451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE leave_credit ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE leave_credit ADD CONSTRAINT FK_2A07F051A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_2A07F051A76ED395 ON leave_credit (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE leave_credit DROP FOREIGN KEY FK_2A07F051A76ED395');
        $this->addSql('DROP INDEX IDX_2A07F051A76ED395 ON leave_credit');
        $this->addSql('ALTER TABLE leave_credit DROP user_id');
    }
}
