<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111211649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, timesheet_id INT NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_795FD9BBABDD46BE (timesheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `leave` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, approved_by_id INT DEFAULT NULL, leave_type_id INT NOT NULL, from_date DATE NOT NULL, to_date DATE DEFAULT NULL, reason VARCHAR(255) DEFAULT NULL, status SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, type SMALLINT NOT NULL, INDEX IDX_9BB080D0A76ED395 (user_id), INDEX IDX_9BB080D02D234F6A (approved_by_id), INDEX IDX_9BB080D08313F474 (leave_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leave_credit (id INT AUTO_INCREMENT NOT NULL, leave_type_id INT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_2A07F0518313F474 (leave_type_id), INDEX IDX_2A07F051A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leave_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE onboarding (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, response SMALLINT NOT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_23A7BB0EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package (id INT AUTO_INCREMENT NOT NULL, customer_name VARCHAR(255) NOT NULL, tracking_number VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, order_value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, owner_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timesheet (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, work_day DATE NOT NULL, hour DOUBLE PRECISION DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_77A4E8D4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, joined_date DATE DEFAULT NULL, date_of_birth DATE DEFAULT NULL, aadhar_number VARCHAR(255) DEFAULT NULL, profile_pic VARCHAR(255) DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, emergency_contact VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBABDD46BE FOREIGN KEY (timesheet_id) REFERENCES timesheet (id)');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D02D234F6A FOREIGN KEY (approved_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D08313F474 FOREIGN KEY (leave_type_id) REFERENCES leave_type (id)');
        $this->addSql('ALTER TABLE leave_credit ADD CONSTRAINT FK_2A07F0518313F474 FOREIGN KEY (leave_type_id) REFERENCES leave_type (id)');
        $this->addSql('ALTER TABLE leave_credit ADD CONSTRAINT FK_2A07F051A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE onboarding ADD CONSTRAINT FK_23A7BB0EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `leave` DROP FOREIGN KEY FK_9BB080D08313F474');
        $this->addSql('ALTER TABLE leave_credit DROP FOREIGN KEY FK_2A07F0518313F474');
        $this->addSql('ALTER TABLE attachment DROP FOREIGN KEY FK_795FD9BBABDD46BE');
        $this->addSql('ALTER TABLE `leave` DROP FOREIGN KEY FK_9BB080D0A76ED395');
        $this->addSql('ALTER TABLE `leave` DROP FOREIGN KEY FK_9BB080D02D234F6A');
        $this->addSql('ALTER TABLE leave_credit DROP FOREIGN KEY FK_2A07F051A76ED395');
        $this->addSql('ALTER TABLE onboarding DROP FOREIGN KEY FK_23A7BB0EA76ED395');
        $this->addSql('ALTER TABLE timesheet DROP FOREIGN KEY FK_77A4E8D4A76ED395');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE `leave`');
        $this->addSql('DROP TABLE leave_credit');
        $this->addSql('DROP TABLE leave_type');
        $this->addSql('DROP TABLE onboarding');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE timesheet');
        $this->addSql('DROP TABLE `user`');
    }
}
