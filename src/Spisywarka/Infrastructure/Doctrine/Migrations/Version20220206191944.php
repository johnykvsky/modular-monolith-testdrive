<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206191944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE id id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL');
        $this->addSql('ALTER TABLE item CHANGE id id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL, CHANGE parent_id parent_id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL, CHANGE category_id category_id CHAR(36) COMMENT \'(DC2Type:uuid)\' NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E727ACA70 FOREIGN KEY (parent_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E727ACA70 ON item (parent_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E12469DE2 ON item (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE id id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E727ACA70');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E12469DE2');
        $this->addSql('DROP INDEX UNIQ_1F1B251E727ACA70 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E12469DE2 ON item');
        $this->addSql('ALTER TABLE item CHANGE id id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE parent_id parent_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE category_id category_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
    }
}
