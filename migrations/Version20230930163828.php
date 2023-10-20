<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930163828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD current_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989A3FAF28 FOREIGN KEY (current_product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_F52993989A3FAF28 ON `order` (current_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989A3FAF28');
        $this->addSql('DROP INDEX IDX_F52993989A3FAF28 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP current_product_id');
    }
}
