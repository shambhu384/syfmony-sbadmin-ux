<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111064356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `leave` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, approved_by_id INT DEFAULT NULL, leave_type_id INT NOT NULL, from_date DATE NOT NULL, to_date DATE DEFAULT NULL, reason VARCHAR(255) DEFAULT NULL, status SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_9BB080D0A76ED395 (user_id), INDEX IDX_9BB080D02D234F6A (approved_by_id), INDEX IDX_9BB080D08313F474 (leave_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leave_credit (id INT AUTO_INCREMENT NOT NULL, leave_type_id INT NOT NULL, INDEX IDX_2A07F0518313F474 (leave_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leave_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D02D234F6A FOREIGN KEY (approved_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D08313F474 FOREIGN KEY (leave_type_id) REFERENCES leave_type (id)');
        $this->addSql('ALTER TABLE leave_credit ADD CONSTRAINT FK_2A07F0518313F474 FOREIGN KEY (leave_type_id) REFERENCES leave_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `leave` DROP FOREIGN KEY FK_9BB080D08313F474');
        $this->addSql('ALTER TABLE leave_credit DROP FOREIGN KEY FK_2A07F0518313F474');
        $this->addSql('DROP TABLE `leave`');
        $this->addSql('DROP TABLE leave_credit');
        $this->addSql('DROP TABLE leave_type');
    }
}
