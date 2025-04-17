<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417191531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__participante AS SELECT id, nome, cpf, data_nascimento, email, numero, aceite_lgpd, created_at, updated_at FROM participante
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE participante
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE participante (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(14) NOT NULL, data_nascimento DATE NOT NULL, email VARCHAR(255) NOT NULL, numero VARCHAR(20) DEFAULT NULL, aceite_lgpd BOOLEAN NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO participante (id, nome, cpf, data_nascimento, email, numero, aceite_lgpd, created_at, updated_at) SELECT id, nome, cpf, data_nascimento, email, numero, aceite_lgpd, created_at, updated_at FROM __temp__participante
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__participante
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE participante ADD COLUMN data_created DATE NOT NULL
        SQL);
    }
}
