<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306192610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE id id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL');
        $this->addSql('ALTER TABLE item CHANGE id id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL, CHANGE parent_id parent_id CHAR(36) COMMENT \'(DC2Type:uuid)\' DEFAULT NULL, CHANGE category_id category_id CHAR(36) COMMENT \'(DC2Type:uuid)\' DEFAULT NULL, CHANGE first_release_date first_release_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE release_date release_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE item CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE parent_id parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE category_id category_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE first_release_date first_release_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE release_date release_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
