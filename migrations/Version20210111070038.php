<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111070038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE onboarding ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE onboarding ADD CONSTRAINT FK_23A7BB0EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_23A7BB0EA76ED395 ON onboarding (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE onboarding DROP FOREIGN KEY FK_23A7BB0EA76ED395');
        $this->addSql('DROP INDEX IDX_23A7BB0EA76ED395 ON onboarding');
        $this->addSql('ALTER TABLE onboarding DROP user_id');
    }
}
