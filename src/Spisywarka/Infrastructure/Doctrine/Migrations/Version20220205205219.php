<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205205219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item CHANGE id id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL, CHANGE name name VARCHAR(250) NOT NULL, CHANGE parent_id parent_id CHAR(36) COMMENT \'(DC2Type:uuid)\' DEFAULT NULL, CHANGE category_id category_id CHAR(36) COMMENT \'(DC2Type:uuid)\' DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE item CHANGE id id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE parent_id parent_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE category_id category_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE name name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
