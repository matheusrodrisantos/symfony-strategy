<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250502005414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registration ADD COLUMN value DOUBLE PRECISION NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registration ADD COLUMN value_paid DOUBLE PRECISION DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_registration ADD COLUMN status VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__event_registration AS SELECT id, user_id, event_id, created_at, updated_at FROM event_registration
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event_registration
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE event_registration (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, event_id INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , CONSTRAINT FK_8FBBAD54A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8FBBAD5471F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO event_registration (id, user_id, event_id, created_at, updated_at) SELECT id, user_id, event_id, created_at, updated_at FROM __temp__event_registration
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__event_registration
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8FBBAD54A76ED395 ON event_registration (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8FBBAD5471F7E88B ON event_registration (event_id)
        SQL);
    }
}
