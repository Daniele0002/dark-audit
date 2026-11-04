<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261104102825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dark_pattern_dark_pattern_characteristic (dark_pattern_id INT NOT NULL, dark_pattern_characteristic_id INT NOT NULL, INDEX IDX_A5D2285172D3AF6A (dark_pattern_id), INDEX IDX_A5D22851DE1F4B58 (dark_pattern_characteristic_id), PRIMARY KEY (dark_pattern_id, dark_pattern_characteristic_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE dark_pattern_characteristic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE dark_pattern_dark_pattern_characteristic ADD CONSTRAINT FK_A5D2285172D3AF6A FOREIGN KEY (dark_pattern_id) REFERENCES dark_pattern (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dark_pattern_dark_pattern_characteristic ADD CONSTRAINT FK_A5D22851DE1F4B58 FOREIGN KEY (dark_pattern_characteristic_id) REFERENCES dark_pattern_characteristic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dark_pattern_dark_pattern_characteristic DROP FOREIGN KEY FK_A5D2285172D3AF6A');
        $this->addSql('ALTER TABLE dark_pattern_dark_pattern_characteristic DROP FOREIGN KEY FK_A5D22851DE1F4B58');
        $this->addSql('DROP TABLE dark_pattern_dark_pattern_characteristic');
        $this->addSql('DROP TABLE dark_pattern_characteristic');
    }
}
