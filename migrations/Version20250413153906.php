<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413153906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
    
        $this->addSql(<<<'SQL'
            CREATE TABLE participante (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(14) NOT NULL, data_nascimento DATE NOT NULL, email VARCHAR(255) NOT NULL, numero VARCHAR(20) DEFAULT NULL, aceite_lgpd BOOLEAN NOT NULL, data_created DATE NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE participante_evento (participante_id INTEGER NOT NULL, evento_id INTEGER NOT NULL, PRIMARY KEY(participante_id, evento_id), CONSTRAINT FK_30B56C3BF6F50196 FOREIGN KEY (participante_id) REFERENCES participante (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_30B56C3B87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_30B56C3BF6F50196 ON participante_evento (participante_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_30B56C3B87A5F842 ON participante_evento (evento_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE evento
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE participante
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE participante_evento
        SQL);
    }
}
