<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261104085815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dark_pattern_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE dark_pattern ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dark_pattern ADD CONSTRAINT FK_5F8750A612469DE2 FOREIGN KEY (category_id) REFERENCES dark_pattern_category (id)');
        $this->addSql('CREATE INDEX IDX_5F8750A612469DE2 ON dark_pattern (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE dark_pattern_category');
        $this->addSql('ALTER TABLE dark_pattern DROP FOREIGN KEY FK_5F8750A612469DE2');
        $this->addSql('DROP INDEX IDX_5F8750A612469DE2 ON dark_pattern');
        $this->addSql('ALTER TABLE dark_pattern DROP category_id');
    }
}
