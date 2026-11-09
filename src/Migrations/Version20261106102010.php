<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261106102010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scan (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(2048) NOT NULL, status VARCHAR(50) NOT NULL, started_at DATETIME DEFAULT NULL, completed_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE scan_result (id INT AUTO_INCREMENT NOT NULL, evidence LONGTEXT NOT NULL, confidence DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, scan_id INT NOT NULL, dark_pattern_id INT NOT NULL, detection_rule_id INT NOT NULL, INDEX IDX_CFDBE4ED2827AAD3 (scan_id), INDEX IDX_CFDBE4ED72D3AF6A (dark_pattern_id), INDEX IDX_CFDBE4ED60C1134E (detection_rule_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE scan_result ADD CONSTRAINT FK_CFDBE4ED2827AAD3 FOREIGN KEY (scan_id) REFERENCES scan (id)');
        $this->addSql('ALTER TABLE scan_result ADD CONSTRAINT FK_CFDBE4ED72D3AF6A FOREIGN KEY (dark_pattern_id) REFERENCES dark_pattern (id)');
        $this->addSql('ALTER TABLE scan_result ADD CONSTRAINT FK_CFDBE4ED60C1134E FOREIGN KEY (detection_rule_id) REFERENCES detection_rule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scan_result DROP FOREIGN KEY FK_CFDBE4ED2827AAD3');
        $this->addSql('ALTER TABLE scan_result DROP FOREIGN KEY FK_CFDBE4ED72D3AF6A');
        $this->addSql('ALTER TABLE scan_result DROP FOREIGN KEY FK_CFDBE4ED60C1134E');
        $this->addSql('DROP TABLE scan');
        $this->addSql('DROP TABLE scan_result');
    }
}
