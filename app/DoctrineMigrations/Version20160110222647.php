<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160110222647 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $table = $schema->getTable('traeger');
        if (!$table->hasColumn('is_active')) {
            $table->addColumn('is_active', 'boolean');
        }

        if ($table->hasColumn('hash')) {
            $table->renameColumn('hash', 'password');
        }

        if (!$table->hasIndex('UNIQ_TRAEGER_EMAIL')) {
            $table->addUniqueIndex(array('email'), 'UNIQ_TRAEGER_EMAIL');
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_80128C17E7927C74 ON traeger');
        $this->addSql('ALTER TABLE traeger DROP is_active, CHANGE password hash VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
