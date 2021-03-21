<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210321162006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE screenshot (screenshot_id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_58991E41166D1F9C (project_id), PRIMARY KEY(screenshot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE screenshot ADD CONSTRAINT FK_58991E41166D1F9C FOREIGN KEY (project_id) REFERENCES project (project_id)');
        $this->addSql('ALTER TABLE project ADD thumbnail_file_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE screenshot');
        $this->addSql('ALTER TABLE project DROP thumbnail_file_name');
    }
}
