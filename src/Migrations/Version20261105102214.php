<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261105102214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detection_rule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, analysis_type VARCHAR(255) NOT NULL, detection_condition LONGTEXT NOT NULL, exclusions LONGTEXT NOT NULL, limitations LONGTEXT NOT NULL, dark_pattern_id INT NOT NULL, INDEX IDX_9B3D7F9F72D3AF6A (dark_pattern_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE detection_rule ADD CONSTRAINT FK_9B3D7F9F72D3AF6A FOREIGN KEY (dark_pattern_id) REFERENCES dark_pattern (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detection_rule DROP FOREIGN KEY FK_9B3D7F9F72D3AF6A');
        $this->addSql('DROP TABLE detection_rule');
    }
}
