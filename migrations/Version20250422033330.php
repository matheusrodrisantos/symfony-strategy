<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422033330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE evento ADD COLUMN created_at DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evento ADD COLUMN updated_at DATETIME NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__evento AS SELECT id, name, tipo, aberto, valor, data_inicio, data_fim, online, presencial FROM evento
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evento
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evento (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tipo VARCHAR(255) NOT NULL, aberto VARCHAR(255) NOT NULL, valor DOUBLE PRECISION NOT NULL, data_inicio DATETIME NOT NULL, data_fim DATETIME NOT NULL, online BOOLEAN NOT NULL, presencial BOOLEAN NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO evento (id, name, tipo, aberto, valor, data_inicio, data_fim, online, presencial) SELECT id, name, tipo, aberto, valor, data_inicio, data_fim, online, presencial FROM __temp__evento
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__evento
        SQL);
    }
}
