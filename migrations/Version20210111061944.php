<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111061944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, timesheet_id INT NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_795FD9BBABDD46BE (timesheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, owner_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timesheet (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, user_id INT DEFAULT NULL, work_day DATE NOT NULL, hour DOUBLE PRECISION NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_77A4E8D4DCD6110 (stock_id), INDEX IDX_77A4E8D4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBABDD46BE FOREIGN KEY (timesheet_id) REFERENCES timesheet (id)');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D4DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timesheet DROP FOREIGN KEY FK_77A4E8D4DCD6110');
        $this->addSql('ALTER TABLE attachment DROP FOREIGN KEY FK_795FD9BBABDD46BE');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE timesheet');
    }
}
