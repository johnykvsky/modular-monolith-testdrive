<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205204839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item ADD parent_id CHAR(36) COMMENT \'(DC2Type:uuid)\' DEFAULT NULL, ADD category_id CHAR(36) COMMENT \'(DC2Type:uuid)\' DEFAULT NULL, ADD slug VARCHAR(250) NOT NULL, ADD author VARCHAR(250) DEFAULT NULL, ADD original_title VARCHAR(250) DEFAULT NULL, ADD description TEXT DEFAULT NULL, ADD content TEXT DEFAULT NULL, ADD parts_count INT DEFAULT NULL, ADD medium_type VARCHAR(250) DEFAULT NULL, ADD first_release_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', ADD release_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', ADD addons TEXT DEFAULT NULL, ADD position INT DEFAULT NULL, ADD translator VARCHAR(250) NOT NULL, ADD cover_type VARCHAR(250) NOT NULL, ADD edition_number INT NOT NULL, ADD info_url VARCHAR(250) NOT NULL, ADD tags VARCHAR(250) NOT NULL, CHANGE id id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP parent_id, DROP category_id, DROP slug, DROP author, DROP original_title, DROP description, DROP content, DROP parts_count, DROP medium_type, DROP first_release_date, DROP release_date, DROP addons, DROP position, DROP translator, DROP cover_type, DROP edition_number, DROP info_url, DROP tags, CHANGE id id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
    }
}
